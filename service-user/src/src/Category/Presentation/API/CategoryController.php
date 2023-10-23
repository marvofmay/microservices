<?php

namespace App\Category\Presentation\API;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

#[Route('/api', name: 'api.')]
class CategoryController
{
    public LoggerInterface $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/categories', name: 'categories.index', methods: ['GET'])]
    public function index(): Response
    {
        $this->logger->info('www');

        return new Response(
            '<html><body>Category list</body></html>'
        );
    }

    #[Route('/categories/{id}',  name: 'categories.show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(int $id): Response
    {
        return new Response(
            '<html><body>Category show ' . $id . '</body></html>'
        );
    }

    #[Route('/categories/',  name: 'categories.create', methods: ['POST'])]
    public function create(int $id): Response
    {
        return new Response(
            '<html><body>Category create</body></html>'
        );
    }

    #[Route('/categories/{id}',  name: 'categories.update', methods: ['PUT'])]
    public function update(int $id): Response
    {
        return new Response(
            '<html><body>Category update</body></html>'
        );
    }

    #[Route('/categories/{id}',  name: 'categories.delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function destroy(int $id): Response
    {
        return new Response(
            '<html><body>Category delete ' . $id . '</body></html>'
        );
    }
}