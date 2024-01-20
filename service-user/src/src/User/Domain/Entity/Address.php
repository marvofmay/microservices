<?php

declare(strict_types = 1);

namespace App\User\Domain\Entity;

use App\User\Structure\AddressType\ResidenceDelivery;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: "address")]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: true)]
class Address
{
    public const COLUMN_UUID = 'uuid';
    public const COLUMN_USER_UUID = 'user_uuid';
    public const COLUMN_STREET = 'street';
    public const COLUMN_POSTCODE = 'postcode';
    public const COLUMN_CITY = 'city';
    public const COLUMN_COUNTRY = 'country';
    public const COLUMN_TYPE = 'type';
    public const COLUMN_CREATED_AT = 'createdAt';
    public const COLUMN_UPDATED_AT = 'updatedAt';
    public const COLUMN_DELETED_AT = 'deletedAt';
    public const RELATION_USER = 'user';

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface $uuid;

    #[ORM\Column(type: "uuid")]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private UuidInterface $user_uuid;

    #[ORM\Column(type: Types::STRING, length: 100)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private string $street;

    #[ORM\Column(type: Types::STRING, length: 15)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private string $postcode;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private string $city;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private string $country;

    #[ORM\Column(type: Types::INTEGER)]
    #[Groups("user_info")]
    private int $type;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeInterface $updatedAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deletedAt = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: User::RELATION_ADDRESSES)]
    #[ORM\JoinColumn(name: self::COLUMN_USER_UUID, referencedColumnName: User::COLUMN_UUID)]
    private User $user;

    public function __construct()
    {
        $this->{self::COLUMN_TYPE} = ResidenceDelivery::RESIDENCE_AND_DELIVERY_VALUE;
    }

    public function getUuid(): UuidInterface
    {
        return $this->{self::COLUMN_UUID};
    }

    public function getUserUuid(): UuidInterface
    {
        return $this->{self::COLUMN_USER_UUID};
    }

    public function getStreet(): string
    {
        return $this->{self::COLUMN_STREET};
    }

    public function getPostcode(): string
    {
        return $this->{self::COLUMN_POSTCODE};
    }

    public function getCity(): string
    {
        return $this->{self::COLUMN_CITY};
    }

    public function getCountry(): string
    {
        return $this->{self::COLUMN_COUNTRY};
    }

    public function getType(): int
    {
        return $this->{self::COLUMN_TYPE};
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->{self::COLUMN_CREATED_AT};
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->{self::COLUMN_UPDATED_AT};
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->{self::COLUMN_DELETED_AT};
    }

    public function getUser(): User
    {
        return $this->{self::RELATION_USER};
    }

    public function setUuid(UuidInterface $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function setUserUuid(UuidInterface $userUuid): void
    {
        $this->user_uuid = $userUuid;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->{self::COLUMN_CREATED_AT} = new \DateTime();
    }

    #[ORM\PrePersist]
    public function setUpdatedAtValue(): void
    {
        $this->{self::COLUMN_UPDATED_AT} = new \DateTime();
    }

    public static function getAttributes(): array
    {
        $reflectionClass = new \ReflectionClass(static::class);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE);

        $attributes = [];
        foreach ($properties as $property) {
            $attributes[] = $property->getName();
        }

        return $attributes;
    }
}