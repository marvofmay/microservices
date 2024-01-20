<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\User;

use App\User\Structure\AddressType\Delivery;
use App\User\Structure\AddressType\Residence;
use App\User\Structure\AddressType\ResidenceDelivery;
use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateDTO implements RequestDtoInterface
{
    #[Assert\NotBlank(message: "Firstname is required!!")]
    #[Assert\Length(min: 3, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    public string $firstName;

    #[Assert\NotBlank(message: "Lastname is required!!")]
    #[Assert\Length(min: 3, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    public string $email;

    #[Assert\NotBlank]
    public string $phone;

    #[Assert\NotBlank]
    public string $password;

    public bool $active;

    #[Assert\NotBlank]
    public array $roles;

    public array $skills;

    public array $interests;

    public ?\DateTimeImmutable $bornOn;

    #[Assert\All([
        new Assert\Collection(
            fields: [
                'street' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 3, max: 100, minMessage: 'minimum 3 letters', maxMessage: 'maximum 100 letters'),
                ],
                'postcode' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 3, max: 15, minMessage: 'minimum 3 characters', maxMessage: 'maximum 15 characters'),
                    new Assert\Regex('/^[A-Za-z0-9\s-]+$/'),
                ],
                'city' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 3, max: 15, minMessage: 'minimum 3 letters', maxMessage: 'maximum 15 letters'),
                ],
                'country' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 3, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters'),
                ],
                'type' => [
                    new Assert\NotBlank(),
                    new Assert\Choice([Residence::RESIDENCE_VALUE, Delivery::DELIVERY_VALUE, ResidenceDelivery::RESIDENCE_AND_DELIVERY_VALUE])
                ],
            ],
            allowExtraFields: false,
            allowMissingFields: false
        )
    ])]
    public array $addresses;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function getBornOn(): ?\DateTimeImmutable
    {
        return $this->bornOn;
    }

    public function getInterests(): array
    {
        return $this->interests;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }
}