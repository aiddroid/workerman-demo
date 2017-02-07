<?php

use Workerman\Worker;

$channelServer = new Channel\Server('0.0.0.0', 2206);

//setup worker
$worker1 = new Worker('text://0.0.0.0:8801');
//set worker name
$worker1->name = 'ChannelWorker';
//set worker count
$worker1->count = 4;
//set onWorkerStart handler
$worker1->onWorkerStart = function ($worker1) {
    Channel\Client::connect('127.0.0.1', 2206);
    Channel\Client::on('broadcast', function ($eventData) use ($worker1){
        foreach ($worker1->connections as $conn) {
            $conn->send($eventData);
        }
    });
};
//set onConnect handler
$worker1->onConnect = function ($connection) {
    echo "#{$connection->id} connected." . PHP_EOL;
};
//set onMessage handler
$worker1->onMessage = function ($connection, $data) {
    Channel\Client::publish('broadcast', $data);
};
