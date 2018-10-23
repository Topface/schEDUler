<?php

namespace Scheduler;

use Predis\Client;

class SchedulerRedisClientFactory implements SchedulerRedisClientFactoryInterface {

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
