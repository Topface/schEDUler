<?php

namespace Topface\Handler\Type;

use Psr\Log\LoggerInterface;
use Scheduler\Handler\HandlerInterface;
use Scheduler\Task\SchedulerTask;

/**
 * Обработчик задачи, который просто пишет что-то в консоль
 */
class LogTypeHandler implements HandlerInterface {
    /** @var LoggerInterface  */
    private $Logger;

    /**
     * @param LoggerInterface $Logger
     */
    public function __construct(
        LoggerInterface $Logger
    ) {
        $this->Logger = $Logger;
    }

    /**
     * Обрабатываем таску и возвращаем результат выполнения
     *
     * @param SchedulerTask $SchedulerTask
     *
     * @return bool
     */
    public function runTask(SchedulerTask $SchedulerTask): bool {
        $message = sprintf(
            'Task[#%s] context: %s',
            $SchedulerTask->getTaskId(),
            implode(',', $SchedulerTask->getContext())
        );

        $this->Logger->notice($message);

        return true;
    }
}
