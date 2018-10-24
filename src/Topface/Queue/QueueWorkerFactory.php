<?php

namespace Topface\Queue;

use DI\Container;
use InvalidArgumentException;
use Scheduler\Worker\QueueWorker;
use Scheduler\Worker\SchedulerWorker;
use Scheduler\Worker\SchedulerWorkerInterface;

class QueueWorkerFactory {
    /**
     * @var Container
     */
    private $Di;

    /**
     * @param Container $Di
     */
    public function __construct(Container $Di) {
        $this->Di = $Di;
    }

    /**
     * @param string $name
     *
     * @return SchedulerWorkerInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function getWorker(string $name): SchedulerWorkerInterface {
        switch ($name) {
            case 'event':
                return $this->Di->get(QueueWorker::class);
            case 'scheduler':
                return $this->Di->get(SchedulerWorker::class);
            default:
                throw new InvalidArgumentException('invalid queue worker');
        }
    }
}
