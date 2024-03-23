<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOption;

use App\User\Domain\Action\SelectOption\UpdateSelectOptionAction;
use App\User\Domain\DTO\SelectOption\UpdateDTO;
use App\User\Domain\Interface\SelectOption\SelectOptionReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-options', name: 'api.select-options.')]
class UpdateSelectOptionController extends AbstractController
{
    public function __construct(private readonly SelectOptionReaderInterface $selectOptionReaderRepository, private readonly LoggerInterface $logger) {}

    #[Route('/{uuid}', name: 'update', methods: ['PUT'])]
    public function update(string $uuid, UpdateDTO $updateDTO, UpdateSelectOptionAction $updateSelectOptionAction): Response
    {
        try {
            if ($uuid !== $updateDTO->getUUID()) {
                return $this->json(['errors' => 'Different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }

            $updateSelectOptionAction->setSelectOptionToUpdate($this->selectOptionReaderRepository->getSelectOptionByUUID($uuid))
                ->execute($updateDTO);

            return $this->json(['message' => 'Select option has been updated.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying select option updated: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... Problem with update select option.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}