<?php

use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;

return [
    SchedulerTaskInterface::class => DI\get(SchedulerTask::class),
];
