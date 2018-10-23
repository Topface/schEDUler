<?php

namespace Scheduler;

use Predis\Client;

interface SchedulerRedisClientFactoryInterface {
    /**
     * Получаем редис для расписания тасок
     *
     * @return Client
     */
    public function getRedisClient(): Client;

    /**
     * Получаем редис для очередей разборщиков
     *
     * @return Client
     */
    public function getRedisQueueClient(): Client;
}
