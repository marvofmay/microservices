<?php

declare(strict_types = 1);

namespace App\User\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity]
#[ORM\Table(
    name: "user",
    uniqueConstraints: [
        new UniqueConstraint(name: "unique_email", columns: ["email"])
    ]
)]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: true)]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    public const COLUMN_UUID = 'uuid';
    public const COLUMN_FIRST_NAME = 'firstName';
    public const COLUMN_LAST_NAME = 'lastName';
    public const COLUMN_PHONE = 'phone';
    public const COLUMN_EMAIL = 'email';
    public const COLUMN_PASSWORD = 'password';
    public const COLUMN_ACTIVE = 'active';
    public const COLUMN_BORN_ON = 'bornOn';
    public const COLUMN_AVATAR = 'avatar';
    public const COLUMN_CREATED_AT = 'createdAt';
    public const COLUMN_UPDATED_AT = 'updatedAt';
    public const COLUMN_DELETED_AT = 'deletedAt';
    public const RELATION_ADDRESSES = 'addresses';
    public const RELATION_ROLES = 'roles';
    public const RELATION_SKILLS = 'skills';
    public const RELATION_INTERESTS = 'interests';

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups("user_info")]
    private UuidInterface $uuid;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private string $firstName;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private string $lastName;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    #[Assert\NotBlank()]
    #[Assert\Email()]
    #[Groups("user_info")]
    private string $email;

    #[ORM\Column(type: Types::STRING, length: 15, nullable: true)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private ?string $phone;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank()]
    #[Groups("user_info")]
    private string $password;

    #[ORM\Column(type: Types::BOOLEAN)]
    #[Groups("user_info")]
    private bool $active = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups("user_info")]
    private ?\DateTimeInterface $bornOn;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups("user_info")]
    private ?string $avatar;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    #[Groups("user_info")]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    #[Groups("user_info")]
    private \DateTimeInterface $updatedAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups("user_info")]
    private ?\DateTimeInterface $deletedAt = null;

    #[ORM\OneToMany(mappedBy: Address::RELATION_USER, targetEntity: Address::class)]
    #[Groups("user_info")]
    public Collection $addresses;

    #[ORM\OneToMany(mappedBy: Role::RELATION_USER, targetEntity: Role::class)]
    #[Groups("user_info")]
    public Collection $roles;

    #[ORM\OneToMany(mappedBy: Skill::RELATION_USER, targetEntity: Skill::class)]
    #[Groups("user_info")]
    public Collection $skills;

    #[ORM\OneToMany(mappedBy: Interest::RELATION_USER, targetEntity: Interest::class)]
    #[Groups("user_info")]
    public Collection $interests;

    public function __construct()
    {
        $this->{self::RELATION_ADDRESSES} = new ArrayCollection();
        $this->{self::RELATION_ROLES} = new ArrayCollection();
        $this->{self::RELATION_SKILLS} = new ArrayCollection();
        $this->{self::RELATION_INTERESTS} = new ArrayCollection();
    }

    public function getUuid(): UuidInterface
    {
        return $this->{self::COLUMN_UUID};
    }

    public function getFirstName(): string
    {
        return $this->{self::COLUMN_FIRST_NAME};
    }

    public function getLastName(): string
    {
        return $this->{self::COLUMN_LAST_NAME};
    }

    public function getEmail(): string
    {
        return $this->{self::COLUMN_EMAIL};
    }

    public function getPhone(): ?string
    {
        return $this->{self::COLUMN_PHONE};
    }

    public function getPassword(): string
    {
        return $this->{self::COLUMN_PASSWORD};
    }

    public function getActive(): bool
    {
        return $this->{self::COLUMN_ACTIVE};
    }

    public function getBornOn(): \DateTimeInterface
    {
        return $this->{self::COLUMN_BORN_ON};
    }

    public function getAvatar(): ?string
    {
        return $this->{self::COLUMN_AVATAR};
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

    public function getRoles(): array
    {
        $arrayOfRolesNames = [];
        foreach ($this->{self::RELATION_ROLES}->toArray() as $role) {
            $arrayOfRolesNames[] = $role->getName();
        }

        return $arrayOfRolesNames;
    }

    public function getSkills(): array
    {
        $arrayOfSkillsNames = [];
        foreach ($this->{self::RELATION_SKILLS}->toArray() as $skill) {
            $arrayOfSkillsNames[] = $skill->getName();
        }

        return $arrayOfSkillsNames;
    }

    public function getInterests(): array
    {
        $arrayOfInterestsNames = [];
        foreach ($this->{self::RELATION_INTERESTS}->toArray() as $interest) {
            $arrayOfInterestsNames[] = $interest->getName();
        }

        return $arrayOfInterestsNames;
    }

    public function getAddressesEntities(): Collection
    {
        return $this->{self::RELATION_ADDRESSES};
    }

    public function getRolesEntities(): Collection
    {
        return $this->{self::RELATION_ROLES};
    }

    public function getSkillsEntities(): Collection
    {
        return $this->{self::RELATION_SKILLS};
    }

    public function getInterestsEntities(): Collection
    {
        return $this->{self::RELATION_INTERESTS};
    }

    public function setUUID(UuidInterface $uuid): void
    {
        $this->{self::COLUMN_UUID} = $uuid;
    }

    public function setFirstName(string $firstName): void
    {
        $this->{self::COLUMN_FIRST_NAME} = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->{self::COLUMN_LAST_NAME} = $lastName;
    }

    public function setEmail(string $email): void
    {
        $this->{self::COLUMN_EMAIL} = $email;
    }

    public function setPhone(?string $phone): void
    {
        $this->{self::COLUMN_PHONE} = $phone;
    }

    public function setPassword(string $password, UserPasswordHasherInterface $passwordHasher): void
    {
        $this->{self::COLUMN_PASSWORD} = $passwordHasher->hashPassword($this, $password);
    }

    public function setActive(bool $active): void
    {
        $this->{self::COLUMN_ACTIVE} = $active;
    }

    public function setBornOn(?\DateTimeInterface $bornOn): void
    {
        $this->{self::COLUMN_BORN_ON} = $bornOn;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->{self::COLUMN_AVATAR} = $avatar;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->{self::COLUMN_CREATED_AT} = $createdAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->{self::COLUMN_UPDATED_AT} = $updatedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): void
    {
        $this->{self::COLUMN_DELETED_AT} = $deletedAt;
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

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
