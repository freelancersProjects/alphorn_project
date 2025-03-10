<?php

namespace App\Entity;

use App\Repository\TestimonialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: TestimonialRepository::class)]
#[Vich\Uploadable]
class Testimonial
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
    private ?File $main_image_file_testimonial = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $first_image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'first_image')]
    private ?File $image_first_file_testimonial = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $second_image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'second_image')]
    private ?File $image_second_file_testimonial = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $third_image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'third_image')]
    private ?File $image_third_file_testimonial = null;

    #[ORM\ManyToOne(inversedBy: 'fk_testimonial')]
    private ?User $fk_id_user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

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

    public function getMainImageFileTestimonial(): ?File
    {
        return $this->main_image_file_testimonial;
    }

    public function setMainImageFileTestimonial(?File $main_image_file_testimonial = null): static
    {
        $this->main_image_file_testimonial = $main_image_file_testimonial;

        if ($main_image_file_testimonial) {
            $this->updated_at = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getFirstImage(): ?string
    {
        return $this->first_image;
    }

    public function setFirstImage(?string $first_image): static
    {
        $this->first_image = $first_image;

        return $this;
    }

    public function getImageFirstFileTestimonial(): ?File
    {
        return $this->image_first_file_testimonial;
    }

    public function setImageFirstFileTestimonial(?File $image_first_file_testimonial = null): static
    {
        $this->image_first_file_testimonial = $image_first_file_testimonial;

        if ($image_first_file_testimonial) {
            $this->updated_at = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getSecondImage(): ?string
    {
        return $this->second_image;
    }

    public function setSecondImage(?string $second_image): static
    {
        $this->second_image = $second_image;

        return $this;
    }

    public function getImageSecondFileTestimonial(): ?File
    {
        return $this->image_second_file_testimonial;
    }

    public function setImageSecondFileTestimonial(?File $image_second_file_testimonial = null): static
    {
        $this->image_second_file_testimonial = $image_second_file_testimonial;

        if ($image_second_file_testimonial) {
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

    public function getImageThirdFileTestimonial(): ?File
    {
        return $this->image_third_file_testimonial;
    }

    public function setImageThirdFileTestimonial(?File $image_third_file_testimonial = null): static
    {
        $this->image_third_file_testimonial = $image_third_file_testimonial;

        if ($image_third_file_testimonial) {
            $this->updated_at = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getFkIdUser(): ?User
    {
        return $this->fk_id_user;
    }

    public function setFkIdUser(?User $fk_id_user): static
    {
        $this->fk_id_user = $fk_id_user;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFkIdUser() ? ($this->getFkIdUser()->getFirstname() . ' ' . $this->getFkIdUser()->getLastname()) : 'Utilisateur inconnu';
    }
}
