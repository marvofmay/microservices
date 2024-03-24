<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOptionKind;

use App\User\Domain\Action\SelectOptionKind\RestoreDeletedSelectOptionKindAction;
use App\User\Domain\Interface\SelectOptionKind\SelectOptionKindReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-option-kinds', name: 'api.select-option-kinds.')]
class RestoreDeletedSelectOptionKindController extends AbstractController
{

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SelectOptionKindReaderInterface $selectOptionKindReaderRepository
    ) {}

    #[Route('/{uuid}/restore-deleted', name: 'restore_deleted', methods: ['PATCH'])]
    public function restoreDeleted(string $uuid, RestoreDeletedSelectOptionKindAction $restoreDeletedSelectOptionKindAction): Response
    {
        try {
            $restoreDeletedSelectOptionKindAction->setSelectOptionKindToRestore(
                $this->selectOptionKindReaderRepository->getSelectOptionKindByUUID($uuid)
            )->execute();

            return $this->json(['message' => 'Select option kind has been restored.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying restore deleted select option kind: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... problem with restore deleted select option kind.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}