<?php

namespace App\User\Presentation\Validation\User\Update;

use App\User\Presentation\Request\User\UpdateRequest;
use App\User\Presentation\Validation\User\Update\Active\NotBlank as ActiveNotBlank;
use App\User\Presentation\Validation\User\Update\Email\Email;
use App\User\Presentation\Validation\User\Update\Email\EmailUnique;
use App\User\Presentation\Validation\User\Update\FirstName\MinLength as FirstNameMinLength;
use App\User\Presentation\Validation\User\Update\FirstName\NotBlank as FirstNameNotBlank;
use App\User\Presentation\Validation\User\Update\LastName\MinLength as LastNameMinLength;
use App\User\Presentation\Validation\User\Update\LastName\NotBlank as LastNameNotBlank;
use App\User\Presentation\Validation\User\Update\Password\NotBlank as PasswordNotBlank;
use App\User\Presentation\Validation\User\Update\Phone\NotBlank as PhoneNotBlank;
use App\User\Presentation\Validation\User\Update\Roles\NotBlank as RolesNotBlank;
use App\User\Presentation\Validation\User\Update\UUID\NotBlank as UUIDNotBlank;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateValidation
{
    private ValidatorInterface $validator;
    private UpdateRequest $updateRequest;
    private array $errorsMessages;
    public function __construct(ValidatorInterface $validator, UpdateRequest $updateRequest)
    {
        $this->validator = $validator;
        $this->updateRequest = $updateRequest;
        $this->errorsMessages = [];
    }

    public function getUpdateRequest(): UpdateRequest
    {
        return $this->updateRequest;
    }

    public function validateUUID(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->updateRequest->getUUID(),
                [new UUIDNotBlank(),]
            )
        );

        return $this;
    }

    public function validateFirstName(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->updateRequest->getFirstName(),
                [new FirstNameNotBlank(), new FirstNameMinLength(),]
            )
        );

        return $this;
    }

    public function validateLastName(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->updateRequest->getLastName(),
                [new LastNameNotBlank(), new LastNameMinLength()]
            )
        );

        return $this;
    }

    public function validatePhone(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->updateRequest->getPhone(), new PhoneNotBlank()));

        return $this;
    }

    public function validateEmail(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->updateRequest->getEmail(), new Email()));

        return $this;
    }

    public function validateEmailUnique(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->updateRequest->getEmail(), new EmailUnique()));

        return $this;
    }

    public function validatePassword(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->updateRequest->getPassword(), new PasswordNotBlank()));

        return $this;
    }

    public function validateActive(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->updateRequest->getActive(), new ActiveNotBlank()));

        return $this;
    }

    public function validateRoles(): self
    {
        $this->setErrorsMessages($this->validator->validate($this->updateRequest->getRoles(), new RolesNotBlank()));

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