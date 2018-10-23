<?php

namespace Topface\TaskHandler;

use Scheduler\Handler\SchedulerHandlerFactoryInterface;
use Scheduler\Handler\SchedulerHandlerInterface;
use Scheduler\Task\SchedulerTask;
use Scheduler\Task\SchedulerTaskInterface;

class SchedulerHandlerFactory implements SchedulerHandlerFactoryInterface {

    /**
     * @param SchedulerTaskInterface $Task
     * @return SchedulerHandlerInterface[]
     */
    public function getHandlers(SchedulerTaskInterface $Task): array {
        $handlers = [];
        if ($Task->getTypeId() == SchedulerTask::WONDERFUL_TYPE) {
            $handlers[] = new AnotherWonderfulHandler();
        }
        if ($Task->getTypeId() == SchedulerTask::SUPER_TYPE) {
            $handlers = new SuperDuperPuperHandler();
        }

        return $handlers;
    }
}
