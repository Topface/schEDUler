<?php

namespace Scheduler\TaskHandler;

use Scheduler\Task\SchedulerTaskInterface;

interface TaskHandlerInterface {
    public function process(SchedulerTaskInterface $Task);
}
