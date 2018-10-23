<?php

namespace Scheduler\SchedulerQueueWorker;

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
     * @param SchedulerQueueStorageInterface $SchedulerQueueStorage
     * @param SchedulerInterface             $Scheduler
     */
    public function __construct(
        SchedulerQueueStorageInterface $SchedulerQueueStorage,
        SchedulerInterface $Scheduler
    ) {
        $this->Scheduler = $Scheduler;
        $this->SchedulerQueueStorage = $SchedulerQueueStorage;
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
            $this->SchedulerQueueStorage->add($Task);
        }
    }
}
