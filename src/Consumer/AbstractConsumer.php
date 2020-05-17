<?php

namespace LateTrains\Kafka\Consumer;

use Exception;
use LateTrains\Kafka\Message\KafkaMessage;

abstract class AbstractConsumer
{
    abstract public function handleMessage(KafkaMessage $message);

    public function __invoke(KafkaMessage $message)
    {
        switch ($message->getError()) {
            case RD_KAFKA_RESP_ERR_NO_ERROR:
                $this->handleMessage($message);
                return;
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                $this->handleNoMoreMessages();
                return;
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                $this->handleTimeout();
                return;
            default:
                throw new Exception($message->getErrorMessage(), $message->getError());
        }
    }

    protected function handleTimeout()
    {
        echo "Time out\n";
    }

    protected function handleNoMoreMessages()
    {
        echo "No more messages; will wait for more\n";
    }
}