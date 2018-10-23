<?php

namespace Scheduler\Worker;

use Scheduler\Handler\SchedulerHandlerFactoryInterface;

class WorkerProcessor implements SchedulerWorkerInterface {
    private $Queue;
    private $HandlerFactory;
    public function __construct(SchedulerWorkerQueueHandlerInterface $Queue, SchedulerHandlerFactoryInterface $HandlerFactory) {
        $this->Queue = $Queue;
        $this->HandlerFactory = $HandlerFactory;
    }

    public function process() {
        $Task = $this->Queue->pop();
        foreach ($this->HandlerFactory->getHandlers() as $Handler) {
            $Handler->process($Task);
        }
    }
}
