<?php

namespace Topface\Controller;

use Scheduler\SchedulerQueueWorker\SchedulerQueueWorkerInterface;

/**
 * @author Andrey Mostovoy
 * @task
 */
class GetSchedullTaskController implements GetSchedullTaskControllerInterface {
    /** @var SchedulerQueueWorkerInterface */
    private $SchedulerQueueWorker;

    /**
     * GetSchedullTaskController constructor.
     * @param SchedulerQueueWorkerInterface $SchedulerQueueWorker
     */
    public function __construct(SchedulerQueueWorkerInterface $SchedulerQueueWorker) {
        $this->SchedulerQueueWorker = $SchedulerQueueWorker;
    }

    /**
     * {@inheritdoc}
     */
    public function start() {
        $this->SchedulerQueueWorker->publishCurrentTasks();
    }
}
