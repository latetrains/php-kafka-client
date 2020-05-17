<?php

use LateTrains\Kafka\Producer\ConfluentProducer;

require '../vendor/autoload.php';

$rk = new ConfluentProducer(
    ["BROKER_URL:9092"],
    'API_KEY',
    'API_SECRET'
);

// Send the current time to the logs topic
$rk->produce(
    'logs',
    (new DateTime())->format('Y-m-d H:i:s')
);
