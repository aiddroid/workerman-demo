<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Workerman\Worker;

//setup worker
$worker4 = new Worker('text://0.0.0.0:8804');

//set worker name
$worker4->name = 'TextWorker';

//set worker count
$worker4->count = 4;

//set onConnect handler
$worker4->onConnect = function ($connection) {
    global $worker4;
    $total = count($worker4->connections);
    foreach ($worker4->connections as $conn) {
        $conn->send("#{$connection->id} entered. total:{$total}");
    }
};

//set onMessage handler
$worker4->onMessage = function ($connection, $data) {
    global $worker4;
    foreach ($worker4->connections as $conn) {
        $conn->send("[#{$connection->id}] said: {$data}");
    }
};

//set onClose handler
$worker4->onClose = function ($connection) {
    global $worker4;
    $total = count($worker4->connections);
    foreach ($worker4->connections as $conn) {
        $conn->send("#{$connection->id} left. total:{$total}");
    }
};

//if not global start,then start at here
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}