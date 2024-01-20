<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\SelectOption;

use App\User\Application\Query\SelectOption\GetSelectOptionsQuery;
use App\User\Application\QueryHandler\SelectOption\GetSelectOptionsQueryHandler;
use App\User\Presentation\Request\SelectOption\ListingRequest;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/select-options', name: 'api.select-options.')]
class ListSelectOptionController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer
    )
    {
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function index(Request $request, GetSelectOptionsQueryHandler $selectOptionsQueryHandler): Response
    {
        try {
            return $this->json([
                'data' =>
                    json_decode($this->serializer->serialize(
                        $selectOptionsQueryHandler->handle(new GetSelectOptionsQuery(new ListingRequest($request))),
                        'json',
                        ['groups' => ['select_option_info']],
                    ))
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('trying show select options: ' . $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}