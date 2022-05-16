<?php

namespace App\Model\Microservice\UseCase\Edit;

use App\Model\Microservice\Entity\MicroserviceSettingsRepository;

class Handler
{
    private MicroserviceSettingsRepository $settingsRepository;

    public function __construct(MicroserviceSettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function handle(Command $command): void
    {
        $settings = $this->settingsRepository->getByName($command->name);

        $settings->edit($command->value);

        $this->settingsRepository->update($settings);
    }
}