<?php

use LateTrains\Kafka\Consumer\AbstractConsumer;
use LateTrains\Kafka\Consumer\ConfluentConsumer;
use LateTrains\Kafka\Message\KafkaMessage;

require '../vendor/autoload.php';

$con = new ConfluentConsumer(
    ["BROKER_URL:9092"],
    'API_KEY',
    'API_SECRET',
    uniqid() // Change this to be a fixed string to add to a consumer group
);

$con->subscribeToTopic('logs');

class TestConsumer extends AbstractConsumer
{
    public function handleMessage(KafkaMessage $message)
    {
        var_dump($message->getPayload());
    }
}

while (true) {
    $con->consumeWithCallback(new TestConsumer);
}