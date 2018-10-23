<?php

namespace Scheduler\SchedulerQueueStorage;

use Predis\Client;

interface SchedulerQueueRedisClientFactoryInterface {
    /**
     * @return Client
     */
    public function getRedisClient(): Client;
}
