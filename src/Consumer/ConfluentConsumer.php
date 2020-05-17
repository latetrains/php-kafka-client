<?php

declare(strict_types=1);

namespace LateTrains\Kafka\Consumer;

use RdKafka\Conf;

class ConfluentConsumer extends KafkaConsumer
{
    public function __construct(array $brokers, string $apiKey, string $apiSecret, string $groupId, Conf $config = null)
    {
        $config ??= new Conf;

        $config->set('sasl.mechanism', 'PLAIN');
        $config->set('api.version.request', 'false');
        $config->set('security.protocol', 'SASL_SSL');
        $config->set('sasl.username', $apiKey);
        $config->set('sasl.password', $apiSecret);

        parent::__construct($brokers, $groupId, $config);
    }

    public function subscribeToTopic(string $topicName) : void
    {
        $this->subscribe([$topicName]);
    }
}