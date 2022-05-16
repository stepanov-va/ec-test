<?php

namespace App\Controller;

use App\Http\MicroserviceInterface;
use App\Model\Microservice\Service\MicroserviceRepository;
use App\Model\Microservice\UseCase\Edit;
use App\Service\Validator\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/microservice", name="microservice")
 */
class MicroserviceController extends AbstractController
{
    private SerializerInterface $serializer;
    private Validator $validator;

    public function __construct(SerializerInterface $serializer, Validator $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @Route("", name=".list", methods={"GET"})
     * @param MicroserviceRepository $microservices
     * @return JsonResponse
     * @throws \Exception
     */
    public function list(MicroserviceRepository $microservices): JsonResponse
    {
        return $this->json(array_map(
            static function (MicroserviceInterface $microservice) {
                return $microservice->getSettings();
            }, $microservices->getMicroservices()
        ));
    }

    /**
     * @Route("", name=".edit", methods={"POST"})
     * @param Request $request
     * @param Edit\Handler $handler
     * @return JsonResponse
     */
    public function edit(Request $request, Edit\Handler $handler): JsonResponse
    {
        /** @var Edit\Command $command */
        $command = $this->serializer->deserialize($request->getContent(), Edit\Command::class, 'json');

        $this->validator->validate($command);

        $handler->handle($command);

        return $this->json([]);
    }
}