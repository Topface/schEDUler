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
            $this->AddController->start();
        } elseif ($Argument->isGet()) {
            $this->GetController->start();
        } elseif ($Argument->isHandle()) {
            $this->HandleController->start();
        } else {
            throw new \RuntimeException('Cannot create controller');
        }
    }
}
