<?php

namespace Scheduler\HandlerWorker;

use Predis\Client;
use Scheduler\Handler\HandlerFactoryInterface;
use Scheduler\SchedulerQueueRedisClientFactoryInterface;
use Scheduler\Task\SchedulerTask;

/**
 * Обрабатываем очередь задач, которые нам нужно выполнить
 */
class HandlerWorker implements HandlerWorkerInterface {
    /**
     * Клиент соединения с очередью тасков
     *
     * @var Client
     */
    private $RedisClient;

    /**
     * Фабрика обработчиков типов тасков
     *
     * @var HandlerFactoryInterface
     */
    private $HandlerFactory;

    /**
     * @param SchedulerQueueRedisClientFactoryInterface $RedisClientFactory
     * @param HandlerFactoryInterface                   $HandlerFactory
     */
    public function __construct(
        SchedulerQueueRedisClientFactoryInterface $RedisClientFactory,
        HandlerFactoryInterface $HandlerFactory
    ) {
        $this->RedisClient = $RedisClientFactory->getRedisClient();
        $this->HandlerFactory = $HandlerFactory;
    }

    /**
     * Получаем новое задание из очереди и обрабатываем его
     */
    public function run() {
        $queueKey = $this->getQueueKey();

        // достаем элемент из очереди
        $this->lock();
        $taskData = $this->RedisClient->spop($queueKey);
        $this->unlock();

        // обрабатываем его, если он есть
        if ($taskData) {
            $array = (array) \msgpack_unpack($taskData);
            $Task = new SchedulerTask(...\array_values($array));

            $this->processTask($Task);
        }

        // чистим память в обработчике, чтобы не текла
        unset($taskData, $Task);

        // чуть-чуть спим для приличия
        usleep(100);
        $this->run();
    }

    /**
     * Получаем хэндлер для задачи и выполняем её
     *
     * @param SchedulerTask $SchedulerTask Задача, которую необходимо выполнить
     */
    public function processTask(SchedulerTask $SchedulerTask) {
        $TaskHandler = $this->HandlerFactory->getHandler($SchedulerTask->getTypeId());
        $TaskHandler->runTask($SchedulerTask);
    }

    /**
     * Установка блокировки
     *
     * @return bool
     */
    private function lock(): bool {
        $Key = $this->getLockKey();
        if ($this->RedisClient->setnx($Key, 1)) {
            $this->RedisClient->expire($Key, 10);
            return true;
        }
        return false;
    }

    /**
     * Снятие блокировки
     */
    private function unlock() {
        $Key = $this->getLockKey();
        $this->RedisClient->del([$Key]);
    }

    /**
     * Возвращает ключ для лока
     *
     * @return string
     */
    private function getLockKey(): string {
        return 'handler_queue_lock';
    }

    /**
     * Возвращает ключ для очереди обработчиков
     *
     * @return string
     */
    private function getQueueKey(): string {
        return 'handler_queue';
    }
}
