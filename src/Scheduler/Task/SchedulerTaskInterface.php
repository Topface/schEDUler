<?php

namespace Scheduler\Task;

/**
 * Таска шедулера
 */
interface SchedulerTaskInterface {

    /**
     * Возвращает время запуска скрипта
     *
     * @return int
     */
    public function getRunTime(): int;

    /**
     * Возвращает уникальный идентификатор задачи
     *
     * @return string
     */
    public function getTaskId(): string;

    /**
     * Возвращает тип задачи
     *
     * @return int
     */
    public function getTypeId(): int;

    /**
     * Контекст необходимый для задачи
     *
     * @return array
     */
    public function getContext(): array;

    /**
     * Возвращает массив с данными таска (для сериализации)
     *
     * @return array
     */
    public function toArray(): array;
}
