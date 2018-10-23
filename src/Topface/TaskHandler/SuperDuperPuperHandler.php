<?php

namespace Topface\TaskHandler;

use Scheduler\Handler\SchedulerHandlerInterface;
use Scheduler\Task\SchedulerTaskInterface;

class SuperDuperPuperHandler implements SchedulerHandlerInterface {

    public function process(SchedulerTaskInterface $Task) {
        echo 'hello world' . PHP_EOL;
    }
}
