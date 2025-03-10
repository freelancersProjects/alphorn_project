<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[Vich\Uploadable]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $language = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, CourseBlock>
     */
    #[ORM\OneToMany(targetEntity: CourseBlock::class, mappedBy: 'course')]
    private Collection $courseBlocks;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 't_content_images', fileNameProperty: 'image')]
    private ?File $image_file_course = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column(nullable: false)]
    private ?int $duration = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $durationUnit;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'course_id')]
    private Collection $user_id;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $is_published = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct()
    {
        $this->courseBlocks = new ArrayCollection();
        $this->user_id = new ArrayCollection();
    }

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

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, CourseBlock>
     */
    public function getCourseBlocks(): Collection
    {
        return $this->courseBlocks;
    }

    public function addCourseBlock(CourseBlock $courseBlock): static
    {
        if (!$this->courseBlocks->contains($courseBlock)) {
            $this->courseBlocks->add($courseBlock);
            $courseBlock->setCourse($this);
        }

        return $this;
    }

    public function removeCourseBlock(CourseBlock $courseBlock): static
    {
        if ($this->courseBlocks->removeElement($courseBlock)) {
            // set the owning side to null (unless already changed)
            if ($courseBlock->getCourse() === $this) {
                $courseBlock->setCourse(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFileCourse(): ?File
    {
        return $this->image_file_course;
    }

    public function setImageFileCourse(?File $image_file_course = null): static
    {
        $this->image_file_course = $image_file_course;

        if ($image_file_course) {
            $this->updated_at = new \DateTimeImmutable();
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDurationUnit(): ?string
    {
        return $this->durationUnit;
    }

    public function setDurationUnit(string $durationUnit): self
    {
        $this->durationUnit = $durationUnit;
        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
            $userId->addCourseId($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        if ($this->user_id->removeElement($userId)) {
            $userId->removeCourseId($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->is_published;
    }

    public function setIsPublished(bool $is_published): static
    {
        $this->is_published = $is_published;

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
