<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class RestController extends AbstractController
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    protected function makeJsonResponse(
        mixed $data,
        array $headers = [],
        $status = Response::HTTP_OK,
    ): JsonResponse {
        $responseData['data'] = $data;
        $responseData['status'] = 1;

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($responseData, 'json'),
            $status,
            $headers,
        );
    }

    public function makeJsonErrorResponse(
        string $message,
        $status = Response::HTTP_BAD_REQUEST,
    ): JsonResponse {
        $responseData['status'] = 0;
        $responseData['error'] = $message;

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($responseData, 'json'),
            $status,
        );
    }
}