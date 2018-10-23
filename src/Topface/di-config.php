<?php

use Scheduler\Scheduler;
use Scheduler\SchedulerInterface;
use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;
use Topface\Controller\AddController;
use Topface\Controller\AddControllerInterface;
use Topface\Controller\ControllerFactory;
use Topface\Controller\ControllerFactoryInterface;
use Topface\Controller\GetSchedullTaskController;
use Topface\Controller\GetSchedullTaskControllerInterface;
use Topface\Controller\HandleSchedullTaskController;
use Topface\Controller\HandleSchedullTaskControllerInterface;

return [
    SchedulerTaskInterface::class => DI\get(SchedulerTask::class),
    SchedulerInterface::class     => DI\get(Scheduler::class),
    AddControllerInterface::class    => DI\get(AddController::class),
    GetSchedullTaskControllerInterface::class    => DI\get(GetSchedullTaskController::class),
    HandleSchedullTaskControllerInterface::class    => DI\get(HandleSchedullTaskController::class),
    ControllerFactoryInterface::class => DI\get(ControllerFactory::class),
];
