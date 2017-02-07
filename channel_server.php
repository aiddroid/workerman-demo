<?php

require_once __DIR__.'/vendor/autoload.php';

use Workerman\Worker;

$channelServer = new Channel\Server('0.0.0.0', 2206);

//setup worker
$worker = new Worker('text://0.0.0.0:8801');
//set worker number
$worker->count = 4;
//set onWorkerStart handler
$worker->onWorkerStart = function ($worker) {
    Channel\Client::connect('127.0.0.1', 2206);
    Channel\Client::on('broadcast', function ($eventData) use ($worker){
        foreach ($worker->connections as $conn) {
            $conn->send($eventData);
        }
    });
};
//set onConnect handler
$worker->onConnect = function ($connection) {
    echo "#{$connection->id} connected." . PHP_EOL;
};
//set onMessage handler
$worker->onMessage = function ($connection, $data) {
    Channel\Client::publish('broadcast', $data);
};
//run worker
Worker::runAll();
