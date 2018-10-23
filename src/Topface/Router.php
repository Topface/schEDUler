<?php

namespace Topface;

use DI\Container;
use Scheduler\ScheduleWorker\ScheduleWorkerInterface;
use Scheduler\TaskWorker\TaskWorkerInterface;

class Router {

    private $DI;

    public function __construct(Container $DI) {
        $this->DI = $DI;
    }

    public function run(string $path) {
        switch ($path) {
            case 'sch_worker':
                $this->DI->get(ScheduleWorkerInterface::class)->run();
                break;
            case 'task_worker':
                $this->DI->get(TaskWorkerInterface::class)->run();
                break;
        }
    }
}
