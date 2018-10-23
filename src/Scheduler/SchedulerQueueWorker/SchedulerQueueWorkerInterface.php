<?php

namespace Scheduler\SchedulerQueueWorker;

/**
 * Интерфейс добавления тасок в очередь обработчиков
 */
interface SchedulerQueueWorkerInterface {
    /**
     * Достаем задания из очереди и публикуем их в очереди обработчиков
     */
    public function publishCurrentTasks();
}