<?php

namespace App\User\Presentation\Validation\User\Create\Email;

use App\User\Domain\Service\ReaderService\UserReaderService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailUniqueValidator extends ConstraintValidator
{
    private UserReaderService $userReaderService;

    public function __construct(UserReaderService $userReaderService) {
        $this->userReaderService = $userReaderService;
    }

    public function validate($value, Constraint $constraint): void
    {
        if ($this->userReaderService->getUserByEmail($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}