<?php

namespace Topface\Controller;

/**
 * @author Andrey Mostovoy
 * @task
 */
class ControllerArgument implements ControllerArgumentInterface {
    /**
     * @var int
     */
    private $runType;

    public function __construct(int $runType) {
        $this->runType = $runType;
    }

    /**
     * @return int
     */
    public function getRunType() {
        return $this->runType;
    }
}
