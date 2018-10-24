<?php

namespace Topface\Controller;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use InvalidArgumentException;

class ControllerFactory {
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
     * @return ControllerInterface
     *
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getController(string $name): ControllerInterface {
        switch ($name) {
            case 'cron':
                return $this->Di->get(CronController::class);
            default:
                throw new InvalidArgumentException(\sprintf('Нету контролера %d', $name));
        }
    }
}
