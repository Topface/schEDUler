<?php

namespace Topface\Redis;

use Predis\Client;
use Scheduler\SchedulerRedisClientFactoryInterface;

/**
 * @author Andrey Mostovoy
 * @task
 */
class RedisClientFactory implements SchedulerRedisClientFactoryInterface {
    /**
     * Получаем редис для расписания задач
     *
     * @return Client
     */
    public function getRedisClient(): Client {
        $Client = new Client();
        return $Client;
    }

    /**
     * Получаем редис для очередей разборщиков
     *
     * @return Client
     */
    public function getRedisQueueClient(): Client {
        $Client = new Client();

        return $Client;
    }
}
