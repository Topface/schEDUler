<?php

use Psr\Log\LoggerInterface;
use Scheduler\HandlerWorker\HandlerWorker;
use Scheduler\HandlerWorker\HandlerWorkerInterface;
use Scheduler\Scheduler;
use Scheduler\SchedulerInterface;
use Scheduler\SchedulerQueueStorage\SchedulerQueueStorage;
use Scheduler\SchedulerQueueStorage\SchedulerQueueStorageInterface;
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
use Topface\Handler\HandlerFactoryConfig;
use Topface\Handler\HandlerFactoryConfigInterface;
use Topface\Handler\Type\ConsoleHandlerInterface;
use Topface\Handler\Type\ConsoleTypeHandler;
use Topface\Handler\Type\LogHandlerInterface;
use Topface\Handler\Type\LogTypeHandler;
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
    SchedulerQueueWorkerInterface::class => DI\get(SchedulerQueueWorker::class),
    SchedulerQueueStorageInterface::class => DI\get(SchedulerQueueStorage::class),
    HandlerFactoryConfigInterface::class => DI\get(HandlerFactoryConfig::class),
    LogHandlerInterface::class => DI\get(LogTypeHandler::class),
    ConsoleHandlerInterface::class => DI\get(ConsoleTypeHandler::class)
];
