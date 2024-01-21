<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOption;

use App\User\Domain\Repository\SelectOption\ReaderRepository\SelectOptionReaderRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/select-options/kinds', name: 'api.select-options-list-kinds.')]
class ListSelectOptionKindController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger, private readonly SelectOptionReaderRepository $selectOptionReaderRepository)
    {
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function index(): Response
    {
        try {
            return $this->json([
                'data' => $this->selectOptionReaderRepository->getSelectOptionsKinds(),
                Response::HTTP_OK
            ]);
        } catch (\Exception $e) {
            $this->logger->error('trying show select options kinds: ' . $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}