<?php

namespace App\Movie\Presentation\Validation\Update;

use App\Movie\Domain\DTO\UpdateDTO;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Movie\Presentation\Validation\Update\Title\NotBlank as TitleNotBlank;
use App\Movie\Presentation\Validation\Update\Title\MinLength as TitleMinLength;
use App\Movie\Presentation\Validation\Update\Active\NotBlank as ActiveNotBlank;
use App\Movie\Presentation\Validation\Update\UUID\NotBlank as UUIDNotBlank;

class UpdateRequestValidation
{
    private ValidatorInterface $validator;
    private array $errorsMessages;

    private UpdateDTO $updateDTO;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->errorsMessages = [];
    }

    public function validateUUID(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->getUpdateDTO()->getUUID(),
                [new UUIDNotBlank(),]
            )
        );

        return $this;
    }

    public function validateTitle(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->getUpdateDTO()->getTitle(),
                [
                    new TitleNotBlank(),
                    new TitleMinLength(),
                ]
            )
        );

        return $this;
    }

    public function validateActive(): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $this->getUpdateDTO()->getActive(),
                new ActiveNotBlank()
            )
        );

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

    public function validate(): array
    {
         return $this->validateUUID()
             ->validateTitle()
             ->validateActive()
             ->getErrorsMessages();
    }

    public function setUpdateDTO(UpdateDTO $updateDTO): self
    {
        $this->updateDTO = $updateDTO;

        return $this;
    }

    public function getUpdateDTO(): UpdateDTO
    {
        return $this->updateDTO;
    }
}