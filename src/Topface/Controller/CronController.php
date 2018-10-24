<?php

namespace Topface\Controller;

use DI\Container;
use InvalidArgumentException;
use Topface\Arg;
use Topface\Queue\QueueWorkerFactory;

class CronController implements ControllerInterface {
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
     * {@inheritdoc}
     */
    public function run(Arg $Arg) {
        $QueueFactory = $this->Di->get(QueueWorkerFactory::class);

        switch ($Arg->getParam('-h')) {
            case 'event':
                $endQueueTime = \time() + 50;
                do {
                    $Worker = $QueueFactory->getWorker('event');
                    $Worker->process();
                    usleep(500);
                } while ($endQueueTime > \time());
                break;
            case 'scheduler':
                $Worker = $QueueFactory->getWorker('scheduler');
                $Worker->process();
                break;
            default:
                throw new InvalidArgumentException('Bad handler');
        }

    }
}
