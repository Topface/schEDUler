<?php

namespace Scheduler\ScheduleWorker;

use Scheduler\SchedulerInterface;
use Scheduler\TaskQueue\TaskQueueHandlerInterface;

class ScheduleWorker implements ScheduleWorkerInterface {

    private $TaskQueueHandler;
    private $Scheduler;

    public function __construct(SchedulerInterface $Scheduler, TaskQueueHandlerInterface $TaskQueueHandler) {
        $this->Scheduler = $Scheduler;
        $this->TaskQueueHandler = $TaskQueueHandler;
    }

    public function run() {
        while ($Tasks = $this->Scheduler->getAndRemove(time())) {
            foreach ($Tasks as $Task) {
                $this->TaskQueueHandler->push($Task);
            }
        }
    }
}
