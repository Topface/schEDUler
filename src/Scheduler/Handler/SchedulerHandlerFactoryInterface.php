<?php

namespace Scheduler\Handler;

interface SchedulerHandlerFactoryInterface {
    /**
     * @return SchedulerHandlerInterface[]
     */
    public function getHandlers(): array;
}
