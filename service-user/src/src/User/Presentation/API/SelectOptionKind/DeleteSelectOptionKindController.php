<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOptionKind;

use App\User\Domain\Action\SelectOptionKind\DeleteSelectOptionKindAction;
use App\User\Domain\Repository\SelectOptionKind\ReaderRepository\SelectOptionKindReaderRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-option-kinds', name: 'api.select-option-kinds.')]
class DeleteSelectOptionKindController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger, private readonly SelectOptionKindReaderRepository $selectOptionKindReaderRepository)
    {
    }

    #[Route('/{uuid}', name: 'destroy', methods: ['DELETE'])]
    public function destroy(string $uuid, DeleteSelectOptionKindAction $deleteSelectOptionKindAction): Response
    {
        try {
            $deleteSelectOptionKindAction->setSelectOptionKindToDelete(
                $this->selectOptionKindReaderRepository->getSelectOptionKindByUUID($uuid)
            )->execute();

            return $this->json(['message' => 'Select option has been deleted.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user delete: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}