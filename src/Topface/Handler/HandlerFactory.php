<?php

namespace Topface\Handler;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Scheduler\Handler\HandlerFactoryInterface;
use Scheduler\Handler\HandlerInterface;

class HandlerFactory implements HandlerFactoryInterface {
    /**
     * @var HandlerFactoryConfig
     */
    private $HandlerFactoryConfig;

    /**
     * @var Container
     */
    private $Di;

    /**
     * HandlerFactory constructor.
     *
     * @param HandlerFactoryConfig $HandlerFactoryConfig
     * @param Container            $Di
     */
    public function __construct(
        HandlerFactoryConfig $HandlerFactoryConfig,
        Container $Di
    ) {
        $this->HandlerFactoryConfig = $HandlerFactoryConfig;
        $this->Di = $Di;
    }

    /**
     * @param int $typeId Тип таска для обработки
     *
     * @return HandlerInterface
     */
    public function getHandler(\int $typeId): HandlerInterface {
        $HandlerType = $this->HandlerFactoryConfig->getHandlersConfig()[$typeId];
        if (!$HandlerType) {
            //todo log error
        }

        try {
            $Handler = $this->Di->get($HandlerType);
        } catch (DependencyException $e) {
        } catch (NotFoundException $e) {
            //todo log error
        }

        return $Handler;
    }
}
