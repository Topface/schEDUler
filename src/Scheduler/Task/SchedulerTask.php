<?php

namespace Scheduler\Task;

class SchedulerTask implements SchedulerTaskInterface {
    const CONSOLE_TASK = 1;
    const LOG_TASK = 2;

    /**
     * @var int
     */
    private $runTime;
    /**
     * @var string
     */
    private $taskId;
    /**
     * @var int
     */
    private $typeId;
    /**
     * @var array
     */
    private $context;

    public function __construct(int $runTime, string $taskId, int $typeId, array $context = []) {
        $this->runTime = $runTime;
        $this->taskId = $taskId;
        $this->typeId = $typeId;
        $this->context = $context;
    }

    /**
     * @inheritdoc
     */
    public function getRunTime(): int {
        return $this->runTime;
    }

    /**
     * @inheritdoc
     */
    public function getTaskId(): string {
        return $this->taskId;
    }

    /**
     * @inheritdoc
     */
    public function getTypeId(): int {
        return $this->typeId;
    }

    /**
     * @inheritdoc
     */
    public function getContext(): array {
        return $this->context;
    }

    /**
     * Возвращает массив с данными объекта (для десереализации)
     *
     * @return array
     */
    public function toArray(): array {
        return [
            'run_time' => $this->runTime,
            'task_id'  => $this->taskId,
            'type_id'  => $this->typeId,
            'context'  => $this->context,
        ];
    }
}
