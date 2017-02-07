<?php

use Workerman\Worker;

//setup worker
$worker3 = new Worker('tcp://0.0.0.0:8803');

//set worker name
$worker3->name = 'TcpWorker';

//setup worker count
$worker3->count = 4;

//setup onMessage handler
$worker3->onMessage = function($connection, $data){
    $connection->send(strrev($data));
};
