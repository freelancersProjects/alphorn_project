<?php

namespace App\Entity;

use App\Repository\InternshipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: InternshipRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $main_image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'main_image')]
    private ?File $main_image_file_internship = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $first_image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'first_image')]
    private ?File $image_first_file_internship = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $second_image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'second_image')]
    private ?File $image_second_file_internship = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $third_image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'third_image')]
    private ?File $image_third_file_internship = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_end = null;
    
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

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

    public function setMainImage(?string $main_image): static
    {
        $this->main_image = $main_image;

        return $this;
    }

    public function getMainImageFileInternship(): ?File
    {
        return $this->main_image_file_internship;
    }

    public function setMainImageFileInternship(?File $main_image_file_internship = null): static
    {
        $this->main_image_file_internship = $main_image_file_internship;

        if ($main_image_file_internship) {
            $this->updated_at = new \DateTimeImmutable();
        }

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

    public function getImageFirstFileInternship(): ?File
    {
        return $this->image_first_file_internship;
    }

    public function setImageFirstFileInternship(?File $image_first_file_internship = null): static
    {
        $this->image_first_file_internship = $image_first_file_internship;

        if ($image_first_file_internship) {
            $this->updated_at = new \DateTimeImmutable();
        }

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

    public function getImageSecondFileInternship(): ?File
    {
        return $this->image_second_file_internship;
    }

    public function setImageSecondFileInternship(?File $image_second_file_internship = null): static
    {
        $this->image_second_file_internship = $image_second_file_internship;

        if ($image_second_file_internship) {
            $this->updated_at = new \DateTimeImmutable();
        }

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

    public function getImageThirdFileInternship(): ?File
    {
        return $this->image_third_file_internship;
    }

    public function setImageThirdFileInternship(?File $image_third_file_internship = null): static
    {
        $this->image_third_file_internship = $image_third_file_internship;

        if ($image_third_file_internship) {
            $this->updated_at = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): static
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): static
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
