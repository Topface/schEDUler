<?php

namespace Scheduler\Handler;

use Scheduler\Task\SchedulerTask;

/**
 * Интерфейс обработчика таски
 */
interface HandlerInterface {
    /**
     * Обрабатываем таску и возвращаем результат выполнения
     *
     * @param SchedulerTask $SchedulerTask
     *
     * @return bool
     */
    public function runTask(SchedulerTask $SchedulerTask): bool;
}