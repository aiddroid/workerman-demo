<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Workerman\Worker;
use \Workerman\Lib\Timer;

//setup worker
$taskWorker = new Worker();

//set worker name
$taskWorker->name = 'TaskWorker';

//set worker count
$taskWorker->count = 1;

//set onWorkerStart handler
$taskWorker->onWorkerStart = function($task){
    $timeInterval = 1.0;
    echo "timeInterval:{$timeInterval}" . PHP_EOL;
    $counter = 0;
    $timerId = Timer::add($timeInterval, function () use (&$timerId, &$counter){
        if ($counter < 5) {
            $time = date('Y-m-d H:i:s');
            $counter++;
            echo "#{$counter} current time:{$time}" . PHP_EOL;
        } else {
            Timer::del($timerId);
            echo "timer deleted." . PHP_EOL;
        }
    });
};

//if not global start,then start at here
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}