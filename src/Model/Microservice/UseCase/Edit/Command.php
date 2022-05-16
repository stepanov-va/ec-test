<?php

namespace App\Model\Microservice\UseCase\Edit;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("array")
     */
    public array $value;

    public function __construct(string $name, array $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}