<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Rabbit\MessagingProducer;

class MessageService
{
    public function __construct(readonly private MessagingProducer $messagingProducer) {}

    public function createMessage(int $numberOfUsers): JsonResponse
    {
        for ($i = 0; $i < $numberOfUsers; $i++) {
            $message = json_encode([
                'sender' => 'company_' . $i,
                'receiver' => 'mail_' . $i,
                'message' => 'text_' . $i,
            ]);
            $this->messagingProducer->publish($message);
        }

        return new JsonResponse(['status' => 'Sent!']);
    }
}