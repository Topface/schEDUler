<?php

namespace Scheduler\TaskQueue;

use Predis\Client;

interface TaskQueueRedisClientFactoryInterface {
    /**
     * @return Client
     */
    public function getRedisClient(): Client;
}
