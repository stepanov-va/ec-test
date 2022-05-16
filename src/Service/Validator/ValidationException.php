<?php

namespace App\Service\Validator;

use JetBrains\PhpStorm\Pure;
use LogicException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends LogicException
{
    private ConstraintViolationListInterface $violations;

    #[Pure] public function __construct(
        ConstraintViolationListInterface $violations,
        string $message = 'Invalid input.',
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->violations = $violations;
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}