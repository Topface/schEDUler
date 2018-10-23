<?php

namespace Scheduler\Handler;

use Scheduler\Task\SchedulerTaskInterface;

interface SchedulerHandlerFactoryInterface {
    /**
     * @param SchedulerTaskInterface $Task
     * @return SchedulerHandlerInterface[]
     */
    public function getHandlers(SchedulerTaskInterface $Task): array;
}
