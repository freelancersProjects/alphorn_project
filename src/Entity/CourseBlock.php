<?php

namespace App\Entity;

use App\Enum\CourseBlockType;
use App\Repository\CourseBlockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseBlockRepository::class)]
class CourseBlock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'courseBlocks')]
    private ?Course $course = null;

    #[ORM\Column(enumType: CourseBlockType::class)]
    private ?CourseBlockType $type = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?int $page_number = null;

    #[ORM\Column]
    private ?int $block_order = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getType(): ?CourseBlockType
    {
        return $this->type;
    }

    public function setType(CourseBlockType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPageNumber(): ?int
    {
        return $this->page_number;
    }

    public function setPageNumber(int $page_number): static
    {
        $this->page_number = $page_number;

        return $this;
    }

    public function getBlockOrder(): ?int
    {
        return $this->block_order;
    }

    public function setBlockOrder(int $block_order): static
    {
        $this->block_order = $block_order;

        return $this;
    }
}
