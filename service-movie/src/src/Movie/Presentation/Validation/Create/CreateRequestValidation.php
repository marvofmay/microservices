<?php

namespace App\Movie\Presentation\Validation\Create;

use App\Movie\Domain\DTO\CreateDTO;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Movie\Presentation\Validation\Create\Title\NotBlank as TitleNotBlank;
use App\Movie\Presentation\Validation\Create\Title\MinLength as TitleMinLength;
use App\Movie\Presentation\Validation\Create\Active\NotBlank as ActiveNotBlank;

class CreateRequestValidation
{
    private ValidatorInterface $validator;
    private array $errorsMessages;

    private CreateDTO $createDTO;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->errorsMessages = [];
    }

    public function validateTitle(?string $title): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $title,
                [
                    new TitleNotBlank(),
                    new TitleMinLength(),
                ]
            )
        );

        return $this;
    }

    public function validateActive(string|bool $active): self
    {
        $this->setErrorsMessages(
            $this->validator->validate(
                $active,
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
         foreach ($this->getCreateDTO()->getMovies() as $movie) {
             $this->validateTitle($movie['title'])
                 ->validateActive($movie['active'])
                 ->getErrorsMessages();
         }

         return $this->getErrorsMessages();
    }

    public function setCreateDTO(CreateDTO $createDTO): self
    {
        $this->createDTO = $createDTO;

        return $this;
    }

    public function getCreateDTO(): CreateDTO
    {
        return $this->createDTO;
    }
}