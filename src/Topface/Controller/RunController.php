<?php

namespace Topface\Controller;

use Scheduler\SchedulerInterface;
use Scheduler\Task\SchedulerTask;
use Topface\Route\RouteStrategyInterface;

/**
 * @author Andrey Mostovoy
 * @task
 */
class RunController implements RunControllerInterface {
    /** @var ControllerArgumentInterface */
    private $ControllerArgument;
    /** @var RouteStrategyInterface */
    private $RouteStrategy;
    /** @var SchedulerInterface */
    private $Scheduler;

    /**
     * RunController constructor.
     * @param RouteStrategyInterface $RouteStrategy
     * @param SchedulerInterface $Scheduler
     */
    public function __construct(RouteStrategyInterface $RouteStrategy, SchedulerInterface $Scheduler) {
        $this->RouteStrategy = $RouteStrategy;
        $this->Scheduler = $Scheduler;
    }

    public function setArgument(ControllerArgumentInterface $Argument) {
        $this->ControllerArgument = $Argument;
        $this->RouteStrategy->setArgument($Argument);
    }

    public function start() {
        if ($this->RouteStrategy->shouldAdd()) {
            // Добавлять в очередь задачу
            $Task = new SchedulerTask(123, 'id', 1, ['test' => 1]);
            $this->Scheduler->addOrSet($Task);
        } elseif ($this->RouteStrategy->shouldGetFromSchedule()) {
            // запускаем воркер на вытаскивание из очереди задач шедулера

        } elseif ($this->RouteStrategy->shouldHandleScheduleTask()) {
            // запускаем воркер на обработку задачи

        } else {
            echo sprintf('Huston, use -t 1 or -t 2');
        }
    }
}
