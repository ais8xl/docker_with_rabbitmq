<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MessageService;

class MessageController extends AbstractController
{
    public function __construct(readonly private MessageService $messageService)
    {
    }

    #[Route('/message/{numberOfMessages}', name: 'app_message')]
    public function index($numberOfMessages): JsonResponse
    {
        $this->messageService->createMessage($numberOfMessages);

        return $this->json(['Status' => 'Sent!']);
    }
}
