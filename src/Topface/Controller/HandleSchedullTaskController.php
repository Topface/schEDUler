<?php

namespace Topface\Controller;

use Scheduler\HandlerWorker\HandlerWorkerInterface;

/**
 * @author Andrey Mostovoy
 * @task
 */
class HandleSchedullTaskController implements HandleSchedullTaskControllerInterface {
    /** @var HandlerWorkerInterface  */
    private $HandlerWorker;

    /**
     * HandleSchedullTaskController constructor.
     * @param HandlerWorkerInterface $HandlerWorker
     */
    public function __construct(HandlerWorkerInterface $HandlerWorker) {
        $this->HandlerWorker = $HandlerWorker;
    }

    /**
     * {@inheritdoc}
     */
    public function start() {
        $this->HandlerWorker->run();
    }
}
