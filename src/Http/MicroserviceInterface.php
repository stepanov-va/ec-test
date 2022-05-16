<?php

namespace App\Http;

interface MicroserviceInterface
{
    public function getName(): string;

    public function getSettings(): array;
}