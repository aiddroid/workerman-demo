<?php

require_once __DIR__.'/../vendor/autoload.php';

use Workerman\Worker;

$global_uid = 0;

//setup worker
$worker = new Worker('Text://0.0.0.0:8801');
$worker->count = 4;
$worker->onConnect = function($connection){
    global $global_uid;
    $connection->uid = $global_uid++;
    $connection->send("user[{$connection->uid}] connected from {$connection->getRemoteIp()}");
};
$worker->onMessage = function($connection, $data){
    global $worker;
    foreach($worker->connections as $conn){
        $conn->send("user[{$connection->uid}] said:{$data}");
    }
};
$worker->onError = function($connection, $code, $message){
    echo "Error:{$code} {$message}".PHP_EOL;
};
$worker->onClose = function($connection){
    global $worker;
    foreach($worker->connections as $conn){
        $conn->send("user[{$connection->uid}] logout");
    }
};

Worker::runAll();
