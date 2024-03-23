<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOption;

use App\User\Domain\Action\SelectOption\CreateSelectOptionAction;
use App\User\Domain\DTO\SelectOption\CreateDTO;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-options', name: 'api.select-options.')]
class CreateSelectOptionController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger) { }

    #[Route('', name: 'store', methods: ['POST'])]
    public function store(CreateDTO $createDTO, CreateSelectOptionAction $createSelectOptionAction): Response
    {
        try {
            $createSelectOptionAction->execute($createDTO);

            return $this->json(['message' => 'Select option has been created.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying add new select option: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... problem with add select option'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}