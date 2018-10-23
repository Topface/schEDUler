<?php

namespace Scheduler;

use Predis\Client;

interface SchedulerRedisClientFactoryInterface {

    /**
     * @return Client
     */
    public function getRedisClient(): Client;
}
