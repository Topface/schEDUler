<?php

namespace Scheduler\TaskQueue;

use Predis\Client;

class TaskQueueRedisClientFactory implements TaskQueueRedisClientFactoryInterface {

    private $Redis;

    public function __construct() {
        $this->Redis = new Client([
            'scheme' => 'tcp',
            'host' => 'redis',
            'port' => '6379',
        ]);
    }

    /**
     * @return Client
     */
    public function getRedisClient(): Client {
        return $this->Redis;
    }
}
