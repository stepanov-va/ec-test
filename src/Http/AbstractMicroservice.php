<?php

namespace App\Http;

use App\Model\Microservice\Entity\MicroserviceSettingsRepository;

abstract class AbstractMicroservice implements MicroserviceInterface
{
    protected const NAME = 'default';

    private MicroserviceSettingsRepository $settingsRepository;

    public function __construct(MicroserviceSettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function getName(): string
    {
        return static::NAME;
    }

    public function getSettings(): array
    {
        return $this->settingsRepository->getByName(static::NAME)->getValue();
    }
}