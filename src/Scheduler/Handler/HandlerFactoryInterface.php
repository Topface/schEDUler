<?php

namespace Scheduler\Handler;

/**
 * Фабрика обработчиков очереди
 */
interface HandlerFactoryInterface {
    /**
     * @param int $typeId Тип таска для обработки
     *
     * @return HandlerInterface
     */
    public function getHandler(int $typeId): HandlerInterface;
}
