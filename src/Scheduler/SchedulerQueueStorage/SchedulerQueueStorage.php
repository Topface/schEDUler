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
        $taskData = \msgpack_pack($SchedulerTask->toArray());
        $this->RedisClient->sadd($this->getQueueKey(), [$taskData]);
    }

    /**
     * Достаем и удаляем элемент из очереди хэндлеров
     *
     * @return SchedulerTask|null
     */
    public function pop() {
        $taskData = $this->RedisClient->spop($this->getQueueKey());

        if (!$taskData) {
            return null;
        }

        $taskDataUnpacked = (array) \msgpack_unpack($taskData);
        return new SchedulerTask(...\array_values($taskDataUnpacked));
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
