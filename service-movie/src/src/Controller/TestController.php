<?php

declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test', methods: ['GET'])]
    public function list(): Response
    {
        return $this->json(['data' => 'ddd'], Response::HTTP_OK);
    }
}