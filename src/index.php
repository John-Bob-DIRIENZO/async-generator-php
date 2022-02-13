<?php

use App\Service\Scheduler;
use App\Service\Task;

require dirname(__DIR__) . '/vendor/autoload.php';

$task1 = new Task(call_user_func(function () {
    for ($i = 0; $i <= 3; $i++) {
        echo sprintf("task 1: %d \n", $i);
        yield;
    }
    return "task 1: finished \n";
}));

$task2 = new Task(call_user_func(function () {
    for ($i = 0; $i <= 6; $i++) {
        echo sprintf("task 2: %d \n", $i);
        yield;
    }
    return "task 2: finished \n";
}));

$scheduler = new Scheduler();
$scheduler->enqueue($task1);
$scheduler->enqueue($task2);

$scheduler->run();
