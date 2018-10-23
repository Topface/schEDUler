<?php

namespace Scheduler\SchedulerQueueStorage;

use Predis\Client;
use Scheduler\SchedulerRedisClientFactoryInterface;
use Scheduler\Task\SchedulerTask;

class SchedulerQueueStorage implements SchedulerQueueStorageInterface {
    /**
     * Клиент соединения с очередью тасков
     *
     * @var Client
     */
    private $RedisClient;

    /**
     * @param SchedulerRedisClientFactoryInterface $RedisClientFactory
     */
    public function __construct(
        SchedulerRedisClientFactoryInterface $RedisClientFactory
    ) {
        $this->RedisClient = $RedisClientFactory->getRedisQueueClient();
    }

    /**
     * Добавляем элемент в очередь хэндлеров
     *
     * @param SchedulerTask $SchedulerTask
     */
    public function add(SchedulerTask $SchedulerTask) {
        $this->lock();

        $taskData = \msgpack_pack($SchedulerTask->toArray());
        $this->RedisClient->sadd($this->getQueueKey(), [$taskData]);

        $this->unlock();
    }

    /**
     * Достаем и удаляем элемент из очереди хэндлеров
     *
     * @return SchedulerTask|null
     */
    public function pop() {
        $this->lock();
        $taskData = $this->RedisClient->spop($this->getQueueKey());
        $this->unlock();

        if (!$taskData) {
            return null;
        }

        $taskDataUnpacked = (array) \msgpack_unpack($taskData);
        return new SchedulerTask(...\array_values($taskDataUnpacked));
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
     * Возвращает ключ для лока
     *
     * @return string
     */
    public function getLockKey(): string {
        return 'handler_queue_lock';
    }

    /**
     * Возвращает ключ для очереди обработчиков
     *
     * @return string
     */
    public function getQueueKey(): string {
        return 'handler_queue';
    }
}
