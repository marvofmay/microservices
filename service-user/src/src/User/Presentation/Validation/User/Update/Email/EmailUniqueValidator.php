<?php

namespace App\User\Presentation\Validation\User\Update\Email;

use App\User\Domain\Service\ReaderService\UserReaderService;
use App\User\Presentation\Request\User\UpdateRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailUniqueValidator extends ConstraintValidator
{
    private UserReaderService $userReaderService;
    private UpdateRequest $updateRequest;

    public function __construct(UserReaderService $userReaderService, UpdateRequest $updateRequest) {
        $this->userReaderService = $userReaderService;
        $this->updateRequest = $updateRequest;
    }

    public function validate($value, Constraint $constraint): void
    {
        if ($this->userReaderService->isEmailUsed($value, $this->updateRequest->getUUID())) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}