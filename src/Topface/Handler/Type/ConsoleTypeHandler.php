<?php

namespace Topface\Handler\Type;

use Scheduler\Handler\HandlerInterface;
use Scheduler\Task\SchedulerTask;

/**
 * Обработчик задачи, который просто пишет что-то в консоль
 */
class ConsoleTypeHandler implements HandlerInterface {
    /**
     * Обрабатываем таску и возвращаем результат выполнения
     *
     * @param SchedulerTask $SchedulerTask
     *
     * @return bool
     */
    public function runTask(SchedulerTask $SchedulerTask): bool {
        echo sprintf(
            'Task[#%s] context: %s',
            $SchedulerTask->getTaskId(),
            implode(',', $SchedulerTask->getContext())
        );

        return true;
    }
}
