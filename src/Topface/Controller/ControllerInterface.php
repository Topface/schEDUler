<?php

namespace Topface\Controller;

use DI\Container;
use Topface\Arg;

interface ControllerInterface {
    /**
     * @param Container $Di
     */
    public function __construct(Container $Di);

    /**
     * @param Arg $Arg
     */
    public function run(Arg $Arg);
}
