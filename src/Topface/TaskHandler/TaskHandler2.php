<?php

namespace Topface\TaskHandler;

use Scheduler\Task\SchedulerTaskInterface;
use Scheduler\TaskHandler\TaskHandler2Interface;

class TaskHandler2 implements TaskHandler2Interface {

    public function process(SchedulerTaskInterface $Task) {
        echo 2;
    }
}
