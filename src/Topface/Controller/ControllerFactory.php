<?php

namespace Topface\Controller;

use DI\Container;
use InvalidArgumentException;

/**
 * TODO Описание
 *
 * @author Ivan Lapsnekov
 * @task   TODO номер задачи
 */
class ControllerFactory {
    /**
     * @var Container
     */
    private $Di;

    public function __construct(Container $Di) {
        $this->Di = $Di;
    }

    /**
     * @param string $name
     *
     * @return ControllerInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
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
