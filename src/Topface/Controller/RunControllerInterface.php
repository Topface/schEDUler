<?php

namespace Topface\Controller;

/**
 * @author Andrey Mostovoy
 * @task
 */
interface RunControllerInterface {
    public function setArgument(ControllerArgumentInterface $Argument);
    public function start();
}
