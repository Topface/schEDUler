<?php

namespace Scheduler\TaskWorker;

use Scheduler\TaskHandler\TaskHandlerFactoryInterface;
use Scheduler\TaskQueue\TaskQueueHandlerInterface;

class TaskWorker implements TaskWorkerInterface {

    private $TaskQueueHandler;
    private $TaskHandlerFactory;

    public function __construct(TaskQueueHandlerInterface $TaskQueueHandler, TaskHandlerFactoryInterface $TaskHandlerFactory) {
        $this->TaskQueueHandler = $TaskQueueHandler;
        $this->TaskHandlerFactory = $TaskHandlerFactory;
    }

    public function run() {
        while ($Task = $this->TaskQueueHandler->pop()) {
            $this->TaskHandlerFactory->getTaskHandler($Task->getTypeId())->process($Task);
        }
    }
}
