<?php

namespace Topface\TaskHandler;

use DI\Container;
use LogicException;
use Scheduler\Task\SchedulerTaskInterface;
use Scheduler\TaskHandler\TaskHandler1Interface;
use Scheduler\TaskHandler\TaskHandler2Interface;
use Scheduler\TaskHandler\TaskHandlerFactoryInterface;
use Scheduler\TaskHandler\TaskHandlerInterface;

class TaskHandlerFactory implements TaskHandlerFactoryInterface {

    private $DI;

    public function __construct(Container $DI) {
        $this->DI = $DI;
    }

    public function getTaskHandler(int $taskType): TaskHandlerInterface {
        switch ($taskType) {
            case SchedulerTaskInterface::TYPE_TEST_1:
                return $this->DI->get(TaskHandler1Interface::class);
            case SchedulerTaskInterface::TYPE_TEST_2:
                return $this->DI->get(TaskHandler2Interface::class);
        }

        throw new LogicException('Unsupported task type');
    }
}
