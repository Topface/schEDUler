<?php

namespace Topface\Handler;

use Scheduler\Handler\HandlerFactoryInterface;
use Scheduler\Handler\HandlerInterface;

class HandlerFactory implements HandlerFactoryInterface {
    /**
     * @param int $typeId Тип таска для обработки
     *
     * @return HandlerInterface
     */
    public function getHandler(\int $typeId): HandlerInterface {
        // TODO: Implement getHandler() method.
    }
}
