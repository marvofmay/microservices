<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Entity]
#[ORM\Table(
    name: "movies",
    uniqueConstraints: [
        new UniqueConstraint(name: "unique_title", columns: ["title"])
    ]
)]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: true)]
class Movie
{
    public const TABLE_NAME = 'movies';
    public const COLUMN_UUID = 'uuid';
    public const COLUMN_TITLE = 'title';
    public const COLUMN_ACTIVE = 'active';
    public const COLUMN_CREATED_AT = 'createdAt';
    public const COLUMN_UPDATED_AT = 'updatedAt';
    public const COLUMN_DELETED_AT = 'deletedAt';
    public const RELATION_CATEGORIES = 'categories';

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups("movie_info")]
    private UuidInterface $uuid;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    #[Groups("movie_info")]
    private string $title;

    #[ORM\Column(type: Types::BOOLEAN)]
    #[Groups("movie_info")]
    private bool $active = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    #[Groups("movie_info")]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    #[Groups("movie_info")]
    private \DateTimeInterface $updatedAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups("movie_info")]
    private ?\DateTimeInterface $deletedAt = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: Category::RELATION_MOVIES)]
    #[ORM\JoinTable(
        name: MovieCategory::MOVIES_CATEGORIES_TABLE_NAME,
        joinColumns: [new ORM\JoinColumn(name: MovieCategory::COLUMN_MOVIE_UUID, referencedColumnName: "uuid")],
        inverseJoinColumns: [new ORM\JoinColumn(name: MovieCategory::COLUMN_CATEGORY_UUID, referencedColumnName: "uuid")]
    )]
    #[Groups("movie_info")]
    public Collection $categories;

    public function __construct()
    {
        $this->{self::RELATION_CATEGORIES} = new ArrayCollection();
    }

    public function addCategory(Category $category): self
    {
        $this->{self::RELATION_CATEGORIES}[] = $category;

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->{self::RELATION_CATEGORIES}->removeElement($category);

        return $this;
    }

    public function getCategoriesEntities(): Collection
    {
        return $this->{self::RELATION_CATEGORIES};
    }

    public function getCategories(): array
    {
        $arrayOfCategoriesNames = [];
        foreach ($this->getCategoriesEntities()->toArray() as $category) {
            $arrayOfCategoriesNames[] = $category->getName();
        }

        return $arrayOfCategoriesNames;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setUUID(UuidInterface $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
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
        $this->createdAt = new \DateTime();
    }

    #[ORM\PrePersist]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTime();
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
