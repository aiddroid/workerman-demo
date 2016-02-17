<?php

require_once __DIR__.'/vendor/autoload.php';

use Workerman\Worker;


$worker = new Worker('udp://0.0.0.0:8801');
$worker->count = 4;
$worker->onMessage = function($connection, $data){
    $connection->send('hello world!');
};

Worker::runAll();
