<?php

namespace Scheduler\SchedulerQueueWorker;

use Exception;
use Psr\Log\LoggerInterface;
use Scheduler\SchedulerInterface;
use Scheduler\SchedulerQueueStorage\SchedulerQueueStorage;
use Scheduler\SchedulerQueueStorage\SchedulerQueueStorageInterface;
use Scheduler\Task\SchedulerTask;

/**
 * Обрабатываем запланированные события и публикуем их в очередь
 */
class SchedulerQueueWorker implements SchedulerQueueWorkerInterface {
    /**
     * @var SchedulerInterface
     */
    private $Scheduler;

    /**
     * @var SchedulerQueueStorage
     */
    private $SchedulerQueueStorage;

    /**
     * @var LoggerInterface
     */
    private $Logger;

    /**
     * @param SchedulerQueueStorageInterface $SchedulerQueueStorage
     * @param SchedulerInterface             $Scheduler
     * @param LoggerInterface                $Logger
     */
    public function __construct(
        SchedulerQueueStorageInterface $SchedulerQueueStorage,
        SchedulerInterface $Scheduler,
        LoggerInterface $Logger
    ) {
        $this->Scheduler = $Scheduler;
        $this->SchedulerQueueStorage = $SchedulerQueueStorage;
        $this->Logger = $Logger;
    }

    /**
     * Достаем текущие задачи из планировщика и отправляем их на обработку
     */
    public function publishCurrentTasks() {
        // получаем таски, которые нам нужно обработать
        $currentTime = time();
        $tasks = $this->Scheduler->getAndRemove($currentTime);

        /**
         * @var int $taskId
         * @var SchedulerTask $Task
         */
        foreach($tasks as $taskId => $Task) {
            try {
                $this->SchedulerQueueStorage->add($Task);
            } catch (Exception $Ex) {
                $this->Logger->error($Ex);
            }
        }
    }
}
