<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOptionKind;

use App\User\Application\Query\SelectOptionKind\GetSelectOptionKindsQuery;
use App\User\Application\QueryHandler\SelectOptionKind\GetSelectOptionKindsQueryHandler;
use App\User\Presentation\Request\SelectOption\ListingRequest;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/select-option-kinds', name: 'api.select-options-kinds.')]
class ListSelectOptionKindController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer
    )
    {
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function index(Request $request, GetSelectOptionKindsQueryHandler $selectOptionKindsQueryHandler): Response
    {
        try {
            return $this->json([
                'data' =>
                    json_decode($this->serializer->serialize(
                        $selectOptionKindsQueryHandler->handle(new GetSelectOptionKindsQuery(new ListingRequest($request))),
                        'json',
                        ['groups' => ['select_option_kind_info']],
                    ))
            ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('trying show select option kinds: ' . $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}