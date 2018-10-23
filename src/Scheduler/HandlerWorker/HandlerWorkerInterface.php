<?php

namespace Scheduler\HandlerWorker;

use Scheduler\Task\SchedulerTask;

/**
 * Интерфейс обработчика очереди
 */
interface HandlerWorkerInterface {
    /**
     * Получаем новое задание из очереди и обрабатываем его
     *
     * @return SchedulerTask
     */
    public function processTask(): SchedulerTask;
}