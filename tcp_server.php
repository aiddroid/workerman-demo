<?php

require_once __DIR__.'/vendor/autoload.php';

use Workerman\Worker;

//setup worker
$worker = new Worker('tcp://0.0.0.0:8801');
//setup worker number
$worker->count = 4;
//setup onMessage handler
$worker->onMessage = function($connection, $data){
    $connection->send(strrev($data));
};
//run worker
Worker::runAll();
