<?php

namespace App\Entity;

use App\Repository\InternshipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InternshipRepository::class)]
class Internship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 500)]
    private ?string $main_image = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $first_image = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $second_image = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $third_image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->main_image;
    }

    public function setMainImage(string $main_image): static
    {
        $this->main_image = $main_image;

        return $this;
    }

    public function getFirstImage(): ?string
    {
        return $this->first_image;
    }

    public function setFirstImage(string $first_image): static
    {
        $this->first_image = $first_image;

        return $this;
    }

    public function getSecondImage(): ?string
    {
        return $this->second_image;
    }

    public function setSecondImage(string $second_image): static
    {
        $this->second_image = $second_image;

        return $this;
    }

    public function getThirdImage(): ?string
    {
        return $this->third_image;
    }

    public function setThirdImage(?string $third_image): static
    {
        $this->third_image = $third_image;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
