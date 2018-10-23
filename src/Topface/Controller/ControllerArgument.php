<?php

namespace Topface\Controller;

/**
 * @author Andrey Mostovoy
 * @task
 */
class ControllerArgument implements ControllerArgumentInterface {
    const ADD = 1;
    const GET = 2;
    const HANDLE = 3;

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

    public function isAdd(): bool {
        return $this->runType == self::ADD;
    }

    public function isGet(): bool {
        return $this->runType == self::GET;
    }

    public function isHandle(): bool {
        return $this->runType == self::HANDLE;
    }
}
