<?php

namespace Topface;

use Exception;
use Psr\Log\LoggerInterface;
use Topface\Controller\ControllerFactory;

class Router {
    /**
     * @var ControllerFactory
     */
    private $Factory;

    /**
     * @var LoggerInterface
     */
    private $Logger;

    /**
     * @param ControllerFactory $Factory
     * @param LoggerInterface   $Logger
     */
    public function __construct(ControllerFactory $Factory, LoggerInterface $Logger) {
        $this->Factory = $Factory;
        $this->Logger  = $Logger;
    }

    /**
     * @param Arg $Arg
     */
    public function run(Arg $Arg) {
        $action = $Arg->getAction();
        try {
            $controller = $this->Factory->getController($action);
            $controller->run($Arg);
        } catch (Exception $Ex) {
            $this->Logger->error($Ex);
        }
    }
}
