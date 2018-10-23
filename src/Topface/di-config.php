<?php

use Psr\Log\LoggerInterface;
use Scheduler\Handler\SchedulerHandlerFactoryInterface;
use Scheduler\Scheduler;
use Scheduler\SchedulerInterface;
use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;
use Scheduler\Worker\SchedulerWorkerQueueHandlerInterface;
use Topface\Queue\FirstQueue;
use Topface\TaskHandler\SchedulerHandlerFactory;

return [
    SchedulerTaskInterface::class               => DI\get(SchedulerTask::class),
    SchedulerInterface::class                   => DI\get(Scheduler::class),
    SchedulerWorkerQueueHandlerInterface::class => DI\get(FirstQueue::class),
    SchedulerHandlerFactoryInterface::class     => DI\get(SchedulerHandlerFactory::class),

    LoggerInterface::class => DI\get(\Topface\Logger::class),
];
