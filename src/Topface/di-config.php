<?php

use Scheduler\Scheduler;
use Scheduler\SchedulerInterface;
use Scheduler\SchedulerRedisClientFactory;
use Scheduler\SchedulerRedisClientFactoryInterface;
use Scheduler\ScheduleWorker\ScheduleWorker;
use Scheduler\ScheduleWorker\ScheduleWorkerInterface;
use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;
use Scheduler\TaskHandler\TaskHandler1Interface;
use Scheduler\TaskHandler\TaskHandler2Interface;
use Scheduler\TaskHandler\TaskHandlerFactoryInterface;
use Scheduler\TaskQueue\TaskQueueHandler;
use Scheduler\TaskQueue\TaskQueueHandlerInterface;
use Scheduler\TaskQueue\TaskQueueRedisClientFactory;
use Scheduler\TaskQueue\TaskQueueRedisClientFactoryInterface;
use Scheduler\TaskWorker\TaskWorker;
use Scheduler\TaskWorker\TaskWorkerInterface;
use Topface\TaskHandler\TaskHandler1;
use Topface\TaskHandler\TaskHandler2;
use Topface\TaskHandler\TaskHandlerFactory;

return [
    SchedulerTaskInterface::class => DI\get(SchedulerTask::class),
    TaskHandlerFactoryInterface::class => DI\get(TaskHandlerFactory::class),
    TaskHandler1Interface::class => DI\get(TaskHandler1::class),
    TaskHandler2Interface::class => DI\get(TaskHandler2::class),
    TaskQueueHandlerInterface::class => DI\get(TaskQueueHandler::class),
    TaskWorkerInterface::class => DI\get(TaskWorker::class),
    ScheduleWorkerInterface::class => DI\get(ScheduleWorker::class),
    SchedulerInterface::class => DI\get(Scheduler::class),
    TaskQueueRedisClientFactoryInterface::class => DI\get(TaskQueueRedisClientFactory::class),
    SchedulerRedisClientFactoryInterface::class => DI\get(SchedulerRedisClientFactory::class),
];
