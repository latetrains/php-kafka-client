<?php
declare(strict_types=1);

namespace LateTrains\Kafka\Consumer;

use LateTrains\Kafka\Message\KafkaMessage;
use RdKafka\Conf;
use RdKafka\KafkaConsumer as RdKafkaKafkaConsumer;

class KafkaConsumer extends RdKafkaKafkaConsumer
{
    public function __construct(array $brokers, string $groupId, Conf $config = null)
    {
        $config ??= new Conf;

        $config->set('metadata.broker.list', implode(',', $brokers));
        $config->set('group.id', $groupId);
        $config->set('auto.offset.reset', 'latest');

        parent::__construct($config);
    }

    public function consumeWithCallback(callable $callback, int $timeout = -1): void
    {
        $callback(
            new KafkaMessage(
                parent::consume($timeout)
            )
        );
    }
}