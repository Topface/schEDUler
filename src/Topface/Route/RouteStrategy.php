<?php

namespace Topface\Route;

use Topface\Controller\ControllerArgumentInterface;

/**
 * @author Andrey Mostovoy
 * @task
 */
class RouteStrategy implements RouteStrategyInterface {
    const ADD = 1;
    const GET = 2;
    const HANDLE = 3;

    /** @var ControllerArgumentInterface */
    private $ControllerArgument;

    public function setArgument(ControllerArgumentInterface $Argument) {
        $this->ControllerArgument = $Argument;
    }

    public function shouldAdd(): bool {
        return $this->ControllerArgument->getRunType() == self::ADD;
    }

    public function shouldGetFromSchedule(): bool {
        return $this->ControllerArgument->getRunType() == self::GET;
    }

    public function shouldHandleScheduleTask(): bool {
        return $this->ControllerArgument->getRunType() == self::HANDLE;
    }
}
