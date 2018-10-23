<?php

namespace Scheduler\TaskHandler;

interface TaskHandlerFactoryInterface {
    public function getTaskHandler(int $taskType): TaskHandlerInterface;
}
