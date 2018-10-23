<?php

namespace Topface\TaskHandler;

use Scheduler\Handler\SchedulerHandlerInterface;
use Scheduler\Task\SchedulerTaskInterface;

class AnotherWonderfulHandler implements SchedulerHandlerInterface {
    public function process(SchedulerTaskInterface $Task) {
        echo "it's a wonderful wonderful life" . PHP_EOL;
    }
}
