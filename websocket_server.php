<?php

require_once __DIR__.'/vendor/autoload.php';

use Workerman\Worker;

//setup worker
$worker = new Worker('websocket://0.0.0.0:8801');
//set worker number
$worker->count = 4;
//set onMessage handler
$worker->onMessage = function($connection, $data){
    $connection->send('hello world!');
};
//run worker
Worker::runAll();
