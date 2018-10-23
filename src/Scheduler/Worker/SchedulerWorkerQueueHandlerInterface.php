<?php

namespace Scheduler\Worker;

use Scheduler\Task\SchedulerTaskInterface;

interface SchedulerWorkerQueueHandlerInterface {
    public function pop();
    public function add(SchedulerTaskInterface $Task);
}
