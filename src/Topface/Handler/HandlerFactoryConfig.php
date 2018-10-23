<?php

namespace Topface\Handler;

use Scheduler\Task\SchedulerTask;
use Topface\Handler\Type\LogTypeHandler;

/**
 * Конфиг соответствия типов тасков и их хэндлеров
 */
class HandlerFactoryConfig implements HandlerFactoryConfigInterface {
    /**
     * @return array
     */
    public function getHandlersConfig(): array {
        return [
            SchedulerTask::CONSOLE_TASK => LogTypeHandler::class,
            SchedulerTask::LOG_TASK => LogTypeHandler::class,
        ];
    }
}
