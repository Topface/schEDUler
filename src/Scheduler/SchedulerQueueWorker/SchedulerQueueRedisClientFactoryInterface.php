<?php

namespace Scheduler;

use Predis\Client;

interface SchedulerQueueRedisClientFactoryInterface {
    /**
     * @return Client
     */
    public function getRedisClient(): Client;
}
