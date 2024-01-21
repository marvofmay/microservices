<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOptionKind;

use App\User\Domain\Action\SelectOptionKind\UpdateSelectOptionKindAction;
use App\User\Domain\DTO\SelectOptionKind\UpdateDTO;
use App\User\Domain\Repository\SelectOptionKind\ReaderRepository\SelectOptionKindReaderRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-option-kinds', name: 'api.select-option-kinds.')]
class UpdateSelectOptionKindController extends AbstractController
{
    public function __construct(
        private readonly SelectOptionKindReaderRepository $selectOptionKindReaderRepository,
        private readonly LoggerInterface $logger
    ) { }

    #[Route('/{uuid}', name: 'update', methods: ['PUT'])]
    public function update(string $uuid, UpdateDTO $updateDTO, UpdateSelectOptionKindAction $updateSelectOptionAction): Response
    {
        try {
            if ($uuid !== $updateDTO->getUUID()) {
                return $this->json(['errors' => 'Different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }

            $updateSelectOptionAction->setSelectOptionKindToUpdate(
                $this->selectOptionKindReaderRepository->getSelectOptionKindByUUID($uuid)
            )->execute($updateDTO);

            return $this->json(['message' => 'Select option kind has been updated.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying select option kind updated: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}