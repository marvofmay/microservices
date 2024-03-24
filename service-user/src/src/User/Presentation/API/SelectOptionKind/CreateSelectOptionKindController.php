<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOptionKind;

use App\User\Domain\Action\SelectOptionKind\CreateSelectOptionKindAction;
use App\User\Domain\DTO\SelectOptionKind\CreateDTO;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-option-kinds', name: 'api.select-option-kinds.')]
class CreateSelectOptionKindController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger) { }

    #[Route('', name: 'store', methods: ['POST'])]
    public function store(CreateDTO $createDTO, CreateSelectOptionKindAction $createSelectOptionKindAction): Response
    {
        try {
            $createSelectOptionKindAction->execute($createDTO);

            return $this->json(['message' => 'Select option kind has been created.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying add new select option kind: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... problem with add select option kind.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}