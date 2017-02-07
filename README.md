# workerman-demo
Demos for workerman framework

## install
```shell
composer install
```

## start servers
```shell
php start.php start
```

## result
```shell
----------------------- WORKERMAN -----------------------------
Workerman version:3.3.7          PHP version:7.1.0
------------------------ WORKERS -------------------------------
user          worker           listen                    processes status
allen         ChannelServer    frame://0.0.0.0:2206       1         [OK]
allen         ChannelWorker    text://0.0.0.0:8801        4         [OK]
allen         HttpWorker       http://0.0.0.0:8802        4         [OK]
allen         TcpWorker        tcp://0.0.0.0:8803         4         [OK]
allen         TextWorker       text://0.0.0.0:8804        4         [OK]
allen         TaskWorker       none                       1         [OK]
allen         UdpWorker        udp://0.0.0.0:8805         4         [OK]
allen         WebsocketWorker  websocket://0.0.0.0:8806   4         [OK]
allen         FileMonitor      none                       1         [OK]
----------------------------------------------------------------
```
