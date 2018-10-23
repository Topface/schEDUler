<?php

namespace Scheduler\Handler;

use Scheduler\Task\SchedulerTaskInterface;

interface SchedulerHandlerInterface {
    public function process(SchedulerTaskInterface $Task);
}
