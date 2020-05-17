<?php
declare(strict_types=1);

namespace LateTrains\Kafka\Message;

use RdKafka\Message;

class KafkaMessage
{
    private Message $rawMessage;


    public function __construct(Message $rawMessage)
    {
        $this->rawMessage = $rawMessage;
    }

    public function getError(): int
    {
        return $this->rawMessage->err;
    }

    public function getErrorMessage(): string
    {
        return $this->rawMessage->errstr();
    }

    public function isError(): bool
    {
        return $this->rawMessage->err !== 0;
    }

    public function getPayload(): string
    {
        return $this->rawMessage->payload;
    }


}