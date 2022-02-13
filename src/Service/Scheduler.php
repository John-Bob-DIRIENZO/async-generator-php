<?php

namespace App\Service;

use JetBrains\PhpStorm\Pure;
use SplQueue;

class Scheduler
{
    private SplQueue $queue;

    #[Pure]
    public function __construct()
    {
        $this->queue = new SplQueue();
    }

    public function enqueue(Task $task)
    {
        $this->queue->enqueue($task);
    }

    public function run()
    {
        while (!$this->queue->isEmpty()) {
            /** @var $task Task */
            $task = $this->queue->dequeue();
            $task->run();

            if (!$task->finished()) {
                $this->enqueue($task);
            } else {
                echo $task->getReturn();
            }
        }
    }
}