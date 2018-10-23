<?php

namespace Scheduler\SchedulerQueueWorker;

use Predis\Client;
use Scheduler\SchedulerInterface;
use Scheduler\SchedulerQueueRedisClientFactoryInterface;

/**
 * Обрабатываем запланированные события и публикуем их в очередь
 */
class SchedulerQueueWorker implements SchedulerQueueWorkerInterface {
    /**
     * @var SchedulerInterface
     */
    private $Scheduler;

    /**
     * @var Client
     */
    private $RedisClient;

    /**
     * @param SchedulerInterface                   $Scheduler
     * @param SchedulerQueueRedisClientFactoryInterface $RedisClientFactory
     */
    public function __construct(
        SchedulerInterface $Scheduler,
        SchedulerQueueRedisClientFactoryInterface $RedisClientFactory
    ) {
        $this->Scheduler = $Scheduler;
        $this->RedisClient = $RedisClientFactory->getRedisClient();
    }

    /**
     * Достаем текущие задачи из планировщика и отправляем их на обработку
     */
    public function publishCurrentTasks() {
        // получаем таски, которые нам нужно обработать
        $currentTime = time();
        $tasks = $this->Scheduler->getAndRemove($currentTime);


        // публикуем таски в очередь обработчиков
        $this->lock();

        $handlerQueueKey = $this->getQueueKey();
        foreach($tasks as $taskId => $Task) {
            $taskData = \msgpack_pack($Task->toArray());

            $this->RedisClient->sadd($handlerQueueKey, $taskData);
        }

        $this->unlock();
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
    private function getLockKey(): string {
        return 'handler_queue_lock';
    }

    /**
     * Возвращает ключ для очереди обработчиков
     *
     * @return string
     */
    private function getQueueKey(): string {
        return 'handler_queue';
    }
}
