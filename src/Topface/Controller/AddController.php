<?php

namespace Topface\Controller;

use Scheduler\SchedulerInterface;
use Scheduler\Task\SchedulerTask;

/**
 * @author Andrey Mostovoy
 * @task
 */
class AddController implements AddControllerInterface {
    /** @var SchedulerInterface */
    private $Scheduler;

    public function __construct(SchedulerInterface $Scheduler) {
        $this->Scheduler = $Scheduler;
    }

    public function start() {
        $Task = new SchedulerTask(time() + 10, '1', 1, ['test' => 1]);
        $this->Scheduler->addOrSet($Task);
        $Task = new SchedulerTask(time() + 20, '2', 2, ['test' => 2]);
        $this->Scheduler->addOrSet($Task);
    }
}
