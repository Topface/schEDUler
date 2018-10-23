<?php

namespace Scheduler\HandlerWorker;

/**
 * Интерфейс обработчика очереди
 */
interface HandlerWorkerInterface {
    /**
     * Получаем новое задание из очереди и обрабатываем его
     */
    public function run();
}