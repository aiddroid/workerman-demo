<?php

require_once __DIR__ . '/../../vendor/autoload.php';

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

//if not global start,then start at here
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}