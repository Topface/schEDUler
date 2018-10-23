<?php

namespace Topface\Controller;

/**
 * @author Andrey Mostovoy
 * @task
 */
interface ControllerArgumentInterface {
    /**
     * @return int
     */
    public function getRunType();

    public function isAdd(): bool;
    public function isGet(): bool;
    public function isHandle(): bool;
}
