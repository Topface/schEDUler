<?php

namespace Scheduler\Task;

use PHPUnit\Framework\TestCase;

class SchedulerTaskTest extends TestCase {

    public function testGetters() {
        $Task = new SchedulerTask(123, 'id', 1, ['test' => 1]);
        $this->assertEquals(123, $Task->getRunTime());
        $this->assertEquals('id', $Task->getTaskId());
        $this->assertEquals(1, $Task->getTypeId());
        $this->assertEquals(['test' => 1], $Task->getContext());
        $this->assertEquals(
            [
                'run_time' => 123,
                'task_id'  => 'id',
                'type_id'  => 1,
                'context'  => [
                    'test' => 1,
                ],
            ], $Task->toArray()
        );
    }

    public function testEmptyContext() {
        $Task = new SchedulerTask(111, 'i', 2);
        $this->assertEquals(111, $Task->getRunTime());
        $this->assertEquals('i', $Task->getTaskId());
        $this->assertEquals(2, $Task->getTypeId());
        $this->assertEquals([], $Task->getContext());
        $this->assertEquals(
            [
                'run_time' => 111,
                'task_id'  => 'i',
                'type_id'  => 2,
                'context'  => [],
            ], $Task->toArray()
        );
    }
}
