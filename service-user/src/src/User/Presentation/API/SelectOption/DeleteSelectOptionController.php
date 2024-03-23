<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOption;

use App\User\Domain\Action\SelectOption\DeleteSelectOptionAction;
use App\User\Domain\Service\SelectOption\ReaderService\SelectOptionReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-options', name: 'api.select-options.')]
class DeleteSelectOptionController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger, private readonly SelectOptionReaderService $selectOptionReaderService) {}

    #[Route('/{uuid}', name: 'destroy', methods: ['DELETE'])]
    public function destroy(string $uuid, DeleteSelectOptionAction $deleteSelectOptionAction): Response
    {
        try {
            $deleteSelectOptionAction->setSelectOptionToDelete($this->selectOptionReaderService->getSelectOptionByUUID($uuid))
                ->execute();

            return $this->json(['message' => 'Select option has been deleted.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user delete: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... Problem with delete select option.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}