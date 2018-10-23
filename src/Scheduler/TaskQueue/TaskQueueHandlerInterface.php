<?php

namespace Scheduler\TaskQueue;

use Scheduler\Task\SchedulerTaskInterface;

interface TaskQueueHandlerInterface {
    public function push(SchedulerTaskInterface $Task);
    public function pop();
}
