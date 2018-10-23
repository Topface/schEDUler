<?php

namespace Scheduler;

use Scheduler\Task\SchedulerTaskInterface;

/**
 * Основной интерфейс для работы с шедулером
 */
interface SchedulerInterface {

    const LIMIT = 10;

    /**
     * Добавляет в шедулер таск
     * Если при добавлении $taskId уже существует, то таск будет перетерт
     *
     * @param SchedulerTaskInterface $Task
     * @return string $taskId
     */
    public function addOrSet(SchedulerTaskInterface $Task): string;

    /**
     * @param int $timestamp
     * @param int $count
     * @return SchedulerTaskInterface[]
     */
    public function getAndRemove(int $timestamp, int $count = self::LIMIT): array;
}
