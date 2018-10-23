<?php

namespace Topface\Queue;

use Predis\Client;
use Scheduler\SchedulerRedisClientFactoryInterface;
use Scheduler\Task\SchedulerTaskInterface;
use Scheduler\Worker\SchedulerWorkerQueueHandlerInterface;

class FirstQueue implements SchedulerWorkerQueueHandlerInterface {
    /**
     * @var Client
     */
    private $RedisClient;

    public function __construct(SchedulerRedisClientFactoryInterface $RedisClientFactory) {
        $this->RedisClient = $RedisClientFactory->getRedisClient();
    }

    public function pop(): SchedulerTaskInterface {
    }

    public function add(SchedulerTaskInterface $Task) {

    }
}
