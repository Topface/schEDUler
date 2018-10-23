<?php

namespace Scheduler\HandlerWorker;

use Exception;
use Predis\Client;
use Psr\Log\LoggerInterface;
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
     * Логгер для записи событий
     *
     * @var LoggerInterface
     */
    private $Logger;

    /**
     * @param SchedulerQueueStorageInterface $SchedulerQueueStorage
     * @param HandlerFactoryInterface        $HandlerFactory
     * @param LoggerInterface                $Logger
     */
    public function __construct(
        SchedulerQueueStorageInterface $SchedulerQueueStorage,
        HandlerFactoryInterface $HandlerFactory,
        LoggerInterface $Logger
    ) {
        $this->SchedulerQueueStorage = $SchedulerQueueStorage;
        $this->HandlerFactory = $HandlerFactory;
        $this->Logger = $Logger;
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
                $this->Logger->error(
                    sprintf(
                        'Task #%s failed and restarted',
                        $Task->getTaskId()
                    )
                );
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
        try {
            $TaskHandler->runTask($SchedulerTask);
        } catch (Exception $Ex) {
            $this->Logger->error(
                sprintf(
                    'Task #%s handler raise an exception %s, message: %s\n%s',
                    $SchedulerTask->getTaskId(),
                    get_class($Ex),
                    $Ex->getMessage(),
                    $Ex->getTraceAsString()
                )
            );
        }
    }
}
