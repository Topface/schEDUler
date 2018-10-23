<?php

namespace Topface\TaskHandler;

use Scheduler\Task\SchedulerTaskInterface;
use Scheduler\TaskHandler\TaskHandler1Interface;

class TaskHandler1 implements TaskHandler1Interface {

    public function process(SchedulerTaskInterface $Task) {
        echo 1;
    }
}
