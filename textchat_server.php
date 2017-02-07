<?php

require_once __DIR__.'/vendor/autoload.php';

use Workerman\Worker;

//setup worker
$worker = new Worker('text://0.0.0.0:8801');
//set worker number
$worker->count = 4;
//set onConnect handler
$worker->onConnect = function ($connection) {
    global $worker;
    $total = count($worker->connections);
    foreach ($worker->connections as $conn) {
        $conn->send("#{$connection->id} entered. total:{$total}");
    }
};
//set onMessage handler
$worker->onMessage = function ($connection, $data) {
    global $worker;
    foreach ($worker->connections as $conn) {
        $conn->send("#{$connection->id} said:{$data}");
    }
};
//set onClose handler
$worker->onClose = function ($connection) {
    global $worker;
    $total = count($worker->connections);
    foreach ($worker->connections as $conn) {
        $conn->send("#{$connection->id} left. total:{$total}");
    }
};
//run worker
Worker::runAll();
