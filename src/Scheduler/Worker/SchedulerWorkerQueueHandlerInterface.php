<?php

namespace Scheduler\Worker;

use Scheduler\Task\SchedulerTaskInterface;

interface SchedulerWorkerQueueHandlerInterface {
    public function pop(): SchedulerTaskInterface;
    public function add(SchedulerTaskInterface $Task);
}
