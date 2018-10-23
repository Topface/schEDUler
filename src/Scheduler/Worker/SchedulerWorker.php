<?php

namespace Scheduler\Worker;

use Scheduler\SchedulerInterface;

class SchedulerWorker implements SchedulerWorkerInterface {
    private $Scheduler;
    private $Queue;
    public function __construct(SchedulerInterface $Scheduler, SchedulerWorkerQueueHandlerInterface $Queue) {
        $this->Scheduler = $Scheduler;
        $this->Queue = $Queue;
    }

    public function process() {
        $Tasks = $this->Scheduler->getAndRemove(time());
        foreach ($Tasks as $Task) {
            $this->Queue->add($Task);
        }
    }
}
