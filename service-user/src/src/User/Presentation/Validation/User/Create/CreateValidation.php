<?php

namespace App\User\Presentation\Validation\User\Create;

use App\User\Presentation\Request\User\CreateRequest;
use App\User\Presentation\Validation\User\Create\Active\NotBlank as ActiveNotBlank;
use App\User\Presentation\Validation\User\Create\Email\Email;
use App\User\Presentation\Validation\User\Create\Email\EmailUnique;
use App\User\Presentation\Validation\User\Create\FirstName\MinLength as FirstNameMinLength;
use App\User\Presentation\Validation\User\Create\FirstName\NotBlank as FirstNameNotBlank;
use App\User\Presentation\Validation\User\Create\LastName\MinLength as LastNameMinLength;
use App\User\Presentation\Validation\User\Create\LastName\NotBlank as LastNameNotBlank;
use App\User\Presentation\Validation\User\Create\Password\NotBlank as PasswordNotBlank;
use App\User\Presentation\Validation\User\Create\Phone\NotBlank as PhoneNotBlank;
use App\User\Presentation\Validation\User\Create\Roles\NotBlank as RolesNotBlank;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateValidation
{
    private ValidatorInterface $validator;
    private CreateRequest $createRequest;
    private array $errorsMessages;
    public function __construct(CreateRequest $createRequest, ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->createRequest = $createRequest;
        $this->errorsMessages = [];
    }

    public function validateFirstName(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->createRequest->getFirstName(),
                [new FirstNameNotBlank(), new FirstNameMinLength(),]
            )
        );

        return $this;
    }

    public function validateLastName(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->createRequest->getLastName(),
                [new LastNameNotBlank(), new LastNameMinLength()]
            )
        );

        return $this;
    }

    public function validatePhone(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->createRequest->getPhone(), new PhoneNotBlank()));

        return $this;
    }

    public function validateEmail(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->createRequest->getEmail(), new Email()));

        return $this;
    }

    public function validateEmailUnique(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->createRequest->getEmail(), new EmailUnique()));

        return $this;
    }

    public function validatePassword(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->createRequest->getPassword(), new PasswordNotBlank()));

        return $this;
    }

    public function validateActive(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->createRequest->getActive(), new ActiveNotBlank()));

        return $this;
    }

    public function validateRoles(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->createRequest->getRoles(), new RolesNotBlank()));

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