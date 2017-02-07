<?php

use Workerman\Worker;

//setup worker
$worker5 = new Worker('udp://0.0.0.0:8805');

//set worker name
$worker5->name = 'HttpWorker';

//set worker count
$worker5->count = 4;
$worker5->onMessage = function($connection, $data){
    $connection->send('hello world!');
};
