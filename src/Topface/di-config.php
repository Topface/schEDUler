<?php

use Scheduler\HandlerWorker\HandlerWorker;
use Scheduler\HandlerWorker\HandlerWorkerInterface;
use Scheduler\Scheduler;
use Scheduler\SchedulerInterface;
use Scheduler\SchedulerQueueRedisClientFactoryInterface;
use Scheduler\SchedulerQueueWorker\SchedulerQueueWorker;
use Scheduler\SchedulerQueueWorker\SchedulerQueueWorkerInterface;
use Scheduler\SchedulerRedisClientFactoryInterface;
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
use Topface\Redis\RedisClientFactory;

return [
    SchedulerTaskInterface::class => DI\get(SchedulerTask::class),
    SchedulerInterface::class     => DI\get(Scheduler::class),
    AddControllerInterface::class    => DI\get(AddController::class),
    GetSchedullTaskControllerInterface::class    => DI\get(GetSchedullTaskController::class),
    HandlerWorkerInterface::class => DI\get(HandlerWorker::class),
    HandleSchedullTaskControllerInterface::class    => DI\get(HandleSchedullTaskController::class),
    ControllerFactoryInterface::class => DI\get(ControllerFactory::class),
    SchedulerRedisClientFactoryInterface::class => DI\get(RedisClientFactory::class),
    SchedulerQueueRedisClientFactoryInterface::class => DI\get(RedisClientFactory::class),
    SchedulerQueueWorkerInterface::class => DI\get(SchedulerQueueWorker::class),
];
