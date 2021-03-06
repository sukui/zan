<?php
$redis = new swoole_redis();
$redis->on("close", function (){
    echo "closed\n";
});

$redis->on("message", function (){
    echo "message\n";
});

$redis->on("timeout", function(swoole_redis $redis, $timeoutType) {
    assert($timeoutType === SWOOLE_ASYNC_CONNECT_TIMEOUT);
    echo "connect timeout\n";
    $redis->close();
});

$redis->setConnectTimeout(1);

$result = $redis->connect("11.11.11.11", 9000, function ($redis){
    assert(false);
    $redis->close();
});
