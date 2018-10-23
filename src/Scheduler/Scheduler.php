<?php

namespace Scheduler;

use Predis\Client;
use Scheduler\Lock\LockInterface;
use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;

/**
 * Класс расписания выполняемых задач
 */
class Scheduler implements SchedulerInterface {
    /**
     * @var Client
     */
    private $RedisClient;

    public function __construct(SchedulerRedisClientFactoryInterface $RedisClientFactory) {
        $this->RedisClient = $RedisClientFactory->getRedisClient();
    }

    /**
     * Добавляем задачу в пул или устанавливаем новые данные для неё
     *
     * @inheritdoc
     */
    public function addOrSet(SchedulerTaskInterface $Task): string {
        $this->RedisClient->set($this->getTaskKey($Task->getTaskId()), \msgpack_pack($Task->toArray()));
        $this->RedisClient->zadd(
            $this->getScheduleKey(),
            [$Task->getTaskId() => $Task->getRunTime()]
        );
        return $Task->getTaskId();
    }

    /**
     * Достаем таск из очереди и удаляем его оттуда
     *
     * @inheritdoc
     */
    public function getAndRemove(int $timestamp, int $count = self::LIMIT): array {
        // Ставим блокировку на время выборки и удаления тасков из расписания
        $this->lock();
        $ScheduleKey = $this->getScheduleKey();
        // Выбираем ID тасков из расписания, попадающие в нужное время
        $taskIds = $this->RedisClient->zrangebyscore(
            $ScheduleKey, 0, $timestamp, [
                'limit' => [0, $count],
            ]
        );
        $models = [];
        if ($taskIds) {
            $models = \array_flip($taskIds);
            $taskKeys = [];
            foreach ($taskIds as $taskId) {
                // Собираем ключи для получение данных тасков и удаляем их из расписания
                $taskKeys[] = $this->getTaskKey($taskId);
                $this->RedisClient->zrem($ScheduleKey, $taskId);
            }
            $data = $this->RedisClient->mget($taskKeys);
            // Подгружаем данные по таскам
            foreach ($data as $item) {
                $array = (array) \msgpack_unpack($item);
                $Task = new SchedulerTask(...\array_values($array));
                $models[$Task->getTaskId()] = $Task;
            }
            // Взятые таски - удаляем
            $this->RedisClient->del($taskKeys);
            \array_filter($models);
        }
        // Не забываем снять блокировку
        $this->unlock();
        return $models;
    }

    /**
     * Установка блокировки
     *
     * @return bool
     */
    private function lock(): bool {
        $Key = $this->getLockKey();
        if ($this->RedisClient->setnx($Key, 1)) {
            $this->RedisClient->expire($Key, 10);
            return true;
        }
        return false;
    }

    /**
     * Снятие блокировки
     */
    private function unlock() {
        $Key = $this->getLockKey();
        $this->RedisClient->del([$Key]);
    }

    /**
     * Возвращает ключ для хранения данных одной таски по её ID
     *
     * @param string $taskId
     * @return string
     */
    private function getTaskKey(string $taskId): string {
        return 'task:' . $taskId;
    }

    /**
     * Возвращает ключ для лока
     *
     * @return string
     */
    private function getLockKey(): string {
        return 'scheduler_lock';
    }

    /**
     * Возвращает ключ для расписания
     *
     * @return string
     */
    private function getScheduleKey(): string {
        return 'schedule';
    }
}
