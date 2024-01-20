<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\Address;

use App\User\Structure\AddressType\Delivery;
use App\User\Structure\AddressType\Residence;
use App\User\Structure\AddressType\ResidenceDelivery;
use Symfony\Component\Validator\Constraints as Assert;
use Prugala\RequestDto\Dto\RequestDtoInterface;

class CreateDTO implements RequestDtoInterface
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 100, minMessage: 'minimum 3 letters', maxMessage: 'maximum 100 letters')]
    #[Assert\Regex('/^[A-Za-zĄĆĘŃŁÓŚŻŹąćęńłóżź]+$/')]
    public string $street;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 15, minMessage: 'minimum 3 characters', maxMessage: 'maximum 15 characters')]
    #[Assert\Regex('/^[A-Za-z0-9\s-]+$/')]
    public string $postcode;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 15, minMessage: 'minimum 3 letters', maxMessage: 'maximum 15 letters')]
    #[Assert\Regex('/^[A-Za-zĄĆĘŃŁÓŚŻŹąćęńłóżź]+$/')]
    public string $city;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    #[Assert\Regex('/^[A-Za-zĄĆĘŃŁÓŚŻŹąćęńłóżź]+$/')]
    public string $country;

    #[Assert\NotBlank()]
    #[Assert\Choice([Residence::RESIDENCE_VALUE, Delivery::DELIVERY_VALUE, ResidenceDelivery::RESIDENCE_AND_DELIVERY_VALUE])]
    public int $type;

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getType(): int
    {
        return $this->type;
    }
}