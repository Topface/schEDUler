<?php

use Scheduler\Scheduler;
use Scheduler\SchedulerInterface;
use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;
use Topface\Controller\RunControllerInterface;
use Topface\Controller\RunController;
use Topface\Route\RouteStrategy;
use Topface\Route\RouteStrategyInterface;

return [
    SchedulerTaskInterface::class => DI\get(SchedulerTask::class),
    SchedulerInterface::class     => DI\get(Scheduler::class),
    RunControllerInterface::class => DI\get(RunController::class),
    RouteStrategyInterface::class => DI\get(RouteStrategy::class),
];
