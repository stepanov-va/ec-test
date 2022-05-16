<?php

namespace App\Model\Microservice\Service;

use App\Http\MicroserviceInterface;

class MicroserviceRepository
{
    /**
     * @var MicroserviceInterface[]
     */
    private array $microservices = [];

    /**
     * @param MicroserviceInterface[] $microservices
     * @throws \Exception
     */
    public function __construct(iterable $microservices)
    {
        $this->registerMicroservices(...$microservices);
    }

    /**
     * @throws \Exception
     */
    public function getMicroservices(): array
    {
        return $this->microservices;
    }

    /**
     * @throws \Exception
     */
    public function registerMicroservices(MicroserviceInterface ...$microservices): void
    {
        foreach ($microservices as $microservice) {
            $this->registerMicroservice($microservice);
        }
    }

    /**
     * @throws \Exception
     */
    public function registerMicroservice(MicroserviceInterface $microservice): void
    {
        $name = $microservice->getName();

        if (isset($this->microservices[$name])) {
            throw new \RuntimeException(sprintf(
                'Microservice "%s" already exists: "%s". Given: "%s"',
                $name,
                get_class($this->microservices[$name]),
                get_class($microservice)
            ));
        }

        $this->microservices[$name] = $microservice;
    }
}