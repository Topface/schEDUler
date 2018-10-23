<?php

namespace Topface\Controller;

/**
 * @author Andrey Mostovoy
 * @task
 */
class ControllerFactory implements ControllerFactoryInterface {
    private $AddController;
    private $GetController;
    private $HandleController;

    public function __construct(
        AddControllerInterface $AddController,
        GetSchedullTaskControllerInterface $GetController,
        HandleSchedullTaskController $HandleController
    ) {
        $this->AddController = $AddController;
        $this->GetController = $GetController;
        $this->HandleController = $HandleController;
    }

    public function getController(ControllerArgumentInterface $Argument): ControllerInterface {
        if ($Argument->isAdd()) {
            return $this->AddController;
        } elseif ($Argument->isGet()) {
            return $this->GetController;
        } elseif ($Argument->isHandle()) {
            return $this->HandleController;
        } else {
            throw new \RuntimeException('Cannot create controller');
        }
    }
}
