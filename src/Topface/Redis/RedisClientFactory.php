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
     * @return Client
     */
    public function getRedisClient(): Client {
        $Client = new Client();
        return $Client;
    }
}
