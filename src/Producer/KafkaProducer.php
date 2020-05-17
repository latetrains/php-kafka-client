<?php

declare(strict_types=1);

namespace LateTrains\Kafka\Producer;

use RdKafka\Producer;
use RdKafka\Conf;
use RdKafka\TopicConf;

class KafkaProducer extends Producer
{
    public function __construct(array $brokers, Conf $config = null)
    {
        $config ??= new Conf;

        parent::__construct($config);

        $this->addBrokers(implode(',', $brokers));
    }

    public function produce(
        string $topic,
        string $message,
        int $messageFlags = 0,
        TopicConf $topicConf = null,
        int $partitionAllocation = RD_KAFKA_PARTITION_UA
    ) {
        $topic = $this->newTopic($topic, $topicConf ?? new TopicConf);
        $topic->produce($partitionAllocation, $messageFlags, $message);
        $this->flush(-1);
    }
}