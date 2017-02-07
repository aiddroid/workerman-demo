<?php

use Workerman\Worker;

//setup worker
$worker2 = new Worker('http://0.0.0.0:8802');

//set worker name
$worker2->name = 'HttpWorker';

//set worker count
$worker2->count = 4;
//set onMessage handler
$worker2->onMessage = function($connection, $data){
    $connection->send('hello world!');
};
