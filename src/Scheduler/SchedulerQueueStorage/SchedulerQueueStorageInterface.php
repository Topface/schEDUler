<?php

namespace Scheduler\SchedulerQueueStorage;

use Scheduler\Task\SchedulerTask;

interface SchedulerQueueStorageInterface {
    /**
     * Добавляем элемент в очередь хэндлеров
     *
     * @param SchedulerTask $SchedulerTask
     *
     * @return bool
     */
    public function add(SchedulerTask $SchedulerTask);

    /**
     * Достаем и удаляем элемент из очереди хэндлеров
     * Возвращает null, если очередь пуста
     *
     * @return SchedulerTask|null
     */
    public function pop();

    /**
     * Сторейдж очереди должен знать свой ключ для редиса
     * @return string
     */
    public function getQueueKey(): string;

    /**
     * Определяет ключ лока для доступа к очереди
     *
     * @return string
     */
    public function getLockKey(): string;
}
