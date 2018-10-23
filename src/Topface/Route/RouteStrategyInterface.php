<?php

namespace Topface\Route;

use Topface\Controller\ControllerArgumentInterface;

/**
 * @author Andrey Mostovoy
 * @task
 */
interface RouteStrategyInterface {
    public function setArgument(ControllerArgumentInterface $Argument);
    public function shouldAdd(): bool;
    public function shouldGetFromSchedule(): bool;
    public function shouldHandleScheduleTask(): bool;
}
