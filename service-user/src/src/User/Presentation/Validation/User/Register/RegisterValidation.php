<?php

namespace App\User\Presentation\Validation\User\Register;

use App\User\Presentation\Request\User\RegisterRequest;
use App\User\Presentation\Validation\User\Register\Email\Email;
use App\User\Presentation\Validation\User\Register\Email\EmailUnique;
use App\User\Presentation\Validation\User\Register\FirstName\MinLength as FirstNameMinLength;
use App\User\Presentation\Validation\User\Register\FirstName\NotBlank as FirstNameNotBlank;
use App\User\Presentation\Validation\User\Register\LastName\MinLength as LastNameMinLength;
use App\User\Presentation\Validation\User\Register\LastName\NotBlank as LastNameNotBlank;
use App\User\Presentation\Validation\User\Register\Password\NotBlank as PasswordNotBlank;
use App\User\Presentation\Validation\User\Register\Phone\NotBlank as PhoneNotBlank;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterValidation
{
    private ValidatorInterface $validator;
    private RegisterRequest $registerRequest;
    private array $errorsMessages;
    public function __construct(ValidatorInterface $validator, RegisterRequest $registerRequest)
    {
        $this->validator = $validator;
        $this->registerRequest = $registerRequest;
        $this->errorsMessages = [];
    }

    public function validateFirstName(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->registerRequest->getFirstName(),
                [new FirstNameNotBlank(), new FirstNameMinLength(),]
            )
        );

        return $this;
    }

    public function validateLastName(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->registerRequest->getLastName(),
                [new LastNameNotBlank(), new LastNameMinLength()]
            )
        );

        return $this;
    }

    public function validatePhone(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->registerRequest->getPhone(), new PhoneNotBlank()));

        return $this;
    }

    public function validateEmail(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->registerRequest->getEmail(), new Email()));

        return $this;
    }

    public function validateEmailUnique(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->registerRequest->getEmail(), new EmailUnique()));

        return $this;
    }

    public function validatePassword(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->registerRequest->getPassword(), new PasswordNotBlank()));

        return $this;
    }

    public function setErrorsMessages(ConstraintViolationList $violationList): self
    {
        if (count($violationList) > 0) {
            foreach ($violationList as $violation) {
                $this->errorsMessages[] = $violation->getMessage();
            }
        }
        return $this;
    }

    public function getErrorsMessages(): array
    {
        return $this->errorsMessages;
    }
}