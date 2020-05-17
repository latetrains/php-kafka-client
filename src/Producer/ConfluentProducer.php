<?php

declare(strict_types=1);

namespace LateTrains\Kafka\Producer;

use RdKafka\Conf;

class ConfluentProducer extends KafkaProducer
{
    public function __construct(array $brokers, string $apiKey, string $apiSecret, Conf $config = null)
    {
        $config ??= new Conf;

        $config->set('sasl.mechanism', 'PLAIN');
        $config->set('security.protocol', 'SASL_SSL');
        $config->set('sasl.username', $apiKey);
        $config->set('sasl.password', $apiSecret);

        parent::__construct($brokers, $config);
    }
}