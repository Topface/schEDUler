<?php

namespace Scheduler\TaskQueue;

use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;

class TaskQueueHandler implements TaskQueueHandlerInterface {

    const KEY = 'tasks';

    private $TaskQueueRedisClientFactory;

    public function __construct(TaskQueueRedisClientFactoryInterface $TaskQueueRedisClientFactory) {
        $this->TaskQueueRedisClientFactory = $TaskQueueRedisClientFactory;
    }

    public function push(SchedulerTaskInterface $Task) {
        $data = \msgpack_pack($Task->toArray());
        $this->TaskQueueRedisClientFactory->getRedisClient()->lpush(self::KEY, $data);
    }

    public function pop() {
        $data = $this->TaskQueueRedisClientFactory->getRedisClient()->rpop(self::KEY);
        if ($data === null) {
            return null;
        }
        $array = (array) \msgpack_unpack($data);
        return new SchedulerTask(...\array_values($array));
    }
}
