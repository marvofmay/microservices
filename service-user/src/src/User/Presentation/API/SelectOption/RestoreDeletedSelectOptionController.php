<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOption;

use App\User\Domain\Action\SelectOption\RestoreDeletedSelectOptionAction;
use App\User\Domain\Interface\SelectOption\SelectOptionReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-options', name: 'api.select-options.')]
class RestoreDeletedSelectOptionController extends AbstractController
{

    public function __construct(private readonly LoggerInterface $logger, private readonly SelectOptionReaderInterface $selectOptionReaderRepository) {}

    #[Route('/{uuid}/restore-deleted', name: 'restore_deleted', methods: ['PATCH'])]
    public function restoreDeleted(string $uuid, RestoreDeletedSelectOptionAction $restoreDeletedSelectOptionAction): Response
    {
        try {
            $restoreDeletedSelectOptionAction->setSelectOptionToRestore($this->selectOptionReaderRepository->getSelectOptionByUUID($uuid))->execute();

            return $this->json(['message' => 'Select option has been restored.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying restore select option: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... Problem with restore deleted select option.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}