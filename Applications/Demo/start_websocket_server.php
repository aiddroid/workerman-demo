<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Workerman\Worker;

//setup worker
$worker6 = new Worker('websocket://0.0.0.0:8806');

//set worker name
$worker6->name = 'WebsocketWorker';

//set worker count
$worker6->count = 4;

//set onMessage handler
$worker6->onMessage = function($connection, $data){
    $connection->send('hello world!');
};

//if not global start,then start at here
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}