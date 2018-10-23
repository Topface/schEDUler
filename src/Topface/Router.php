<?php

namespace Topface;

use Exception;
use Psr\Log\LoggerInterface;
use Topface\Controller\ControllerFactory;

class Router {
    private $Factory;
    private $Logger;

    public function __construct(ControllerFactory $Factory, LoggerInterface $Logger) {
        $this->Factory = $Factory;
        $this->Logger = $Logger;
    }

    public function run(Arg $Arg) {
        $action = $Arg->getAction();
        try {
            $controller = $this->Factory->getController($action);
            $controller->run($Arg);
        } catch (Exception $Ex) {
            $this->Logger->error(\sprintf('Other exception: ' . $Ex->getMessage()));
        }
    }
}
