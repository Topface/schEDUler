<?php

namespace Scheduler\HandlerWorker;

use Predis\Client;
use Scheduler\Handler\HandlerFactoryInterface;
use Scheduler\SchedulerQueueRedisClientFactoryInterface;
use Scheduler\SchedulerQueueStorage\SchedulerQueueStorageInterface;
use Scheduler\Task\SchedulerTask;

/**
 * Обрабатываем очередь задач, которые нам нужно выполнить
 */
class HandlerWorker implements HandlerWorkerInterface {
    /**
     * Сторейдж доступа к очереди тасков на выполнение
     *
     * @var SchedulerQueueStorageInterface
     */
    private $SchedulerQueueStorage;

    /**
     * Фабрика обработчиков типов тасков
     *
     * @var HandlerFactoryInterface
     */
    private $HandlerFactory;

    /**
     * @param SchedulerQueueStorageInterface $SchedulerQueueStorage
     * @param HandlerFactoryInterface        $HandlerFactory
     */
    public function __construct(
        SchedulerQueueStorageInterface $SchedulerQueueStorage,
        HandlerFactoryInterface $HandlerFactory
    ) {
        $this->SchedulerQueueStorage = $SchedulerQueueStorage;
        $this->HandlerFactory = $HandlerFactory;
    }

    /**
     * Получаем новое задание из очереди и обрабатываем его
     */
    public function run() {
        // достаем элемент из очереди
        $Task = $this->SchedulerQueueStorage->pop();

        if ($Task) {
            $result = $this->processTask($Task);

            if (!$result) {
                $this->SchedulerQueueStorage->add($Task);
            }
        }

        // чистим память в обработчике, чтобы не текла
        unset($Task);

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
}
