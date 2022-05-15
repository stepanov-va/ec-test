<?php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MicroserviceController extends AbstractController
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->json([]);
    }

    /**
     * @return JsonResponse
     */
    public function edit(): JsonResponse
    {
        return $this->json([]);
    }
}