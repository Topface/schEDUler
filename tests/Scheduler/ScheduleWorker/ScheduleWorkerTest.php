<?php

namespace Scheduler\ScheduleWorker;

use PHPUnit\Framework\TestCase;
use Scheduler\Scheduler;
use Scheduler\Task\SchedulerTask;
use Scheduler\TaskQueue\TaskQueueHandler;

class ScheduleWorkerTest extends TestCase {
    public function testRun() {
        $Task = new SchedulerTask(time(), 1, 1);

        $SchedulerMock = $this->getMockBuilder(Scheduler::class)
            ->disableOriginalConstructor()
            ->setMethods(['getAndRemove'])
            ->getMock();
        $SchedulerMock->expects($this->at(0))
            ->method('getAndRemove')
            ->willReturn([$Task]);
        $SchedulerMock->expects($this->at(1))
            ->method('getAndRemove')
            ->willReturn([]);

        $TaskQueueHandlerMock = $this->getMockBuilder(TaskQueueHandler::class)
            ->disableOriginalConstructor()
            ->setMethods(['push'])
            ->getMock();
        $TaskQueueHandlerMock->expects($this->once())
            ->method('push')
            ->with($Task);

        $ScheduleTask = new ScheduleWorker($SchedulerMock, $TaskQueueHandlerMock);
        $ScheduleTask->run();
    }
}
