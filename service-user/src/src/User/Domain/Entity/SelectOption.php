<?php

declare(strict_types = 1);

namespace App\User\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: "select_option")]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: true)]
class SelectOption
{
    public const COLUMN_UUID = 'uuid';
    public const COLUMN_VALUE = 'value';
    public const COLUMN_NAME = 'name';
    public const COLUMN_KIND = 'kind';
    public const COLUMN_CREATED_AT = 'createdAt';
    public const COLUMN_UPDATED_AT = 'updatedAt';
    public const COLUMN_DELETED_AT = 'deletedAt';

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups("select_option_info")]
    private UuidInterface $uuid;

    #[ORM\Column(type: Types::STRING, length: 30)]
    #[Assert\NotBlank()]
    #[Groups("select_option_info")]
    private string $value;

    #[ORM\Column(type: Types::STRING, length: 30)]
    #[Assert\NotBlank()]
    #[Groups("select_option_info")]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 30)]
    #[Assert\NotBlank()]
    #[Groups("select_option_info")]
    private string $kind;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeInterface $updatedAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups("select_option_info")]
    private ?\DateTimeInterface $deletedAt = null;

    public function getUuid(): UuidInterface
    {
        return $this->{self::COLUMN_UUID};
    }

    public function getValue(): string
    {
        return $this->{self::COLUMN_VALUE};
    }

    public function getName(): string
    {
        return $this->{self::COLUMN_NAME};
    }

    public function getKind(): string
    {
        return $this->{self::COLUMN_KIND};
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

    public function setUuid(UuidInterface $uuid): void
    {
        $this->{self::COLUMN_UUID} = $uuid;
    }

    public function setValue(string $value): void
    {
        $this->{self::COLUMN_VALUE} = $value;
    }

    public function setName(string $name): void
    {
        $this->{self::COLUMN_NAME} = $name;
    }

    public function setKind(string $kind): void
    {
        $this->{self::COLUMN_KIND} = $kind;
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

    public function getUserIdentifier(): string
    {
        return $this->getUuid()->__toString();
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