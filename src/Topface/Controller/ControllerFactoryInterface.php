<?php

namespace Topface\Controller;

/**
 * @author Andrey Mostovoy
 */
interface ControllerFactoryInterface {
    public function getController(ControllerArgumentInterface $Argument): ControllerInterface;
}
