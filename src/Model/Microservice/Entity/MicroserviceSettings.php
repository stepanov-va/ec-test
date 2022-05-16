<?php

namespace App\Model\Microservice\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Microservice\Entity\MicroserviceSettingsRepository")
 */
class MicroserviceSettings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="json")
     */
    private array $value;

    public function __construct(string $name, array $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getValue(): array
    {
        return $this->value;
    }

    public function edit(array $value): void
    {
        $this->value = $value;
    }
}