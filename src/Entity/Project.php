<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Название проекта не может быть пустым.')]
    #[Length(
        max: 255,
        maxMessage: 'Название проекта не может превышать {{ limit }} символов.'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[NotBlank(message: 'Описание не может быть пустым.')]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Developer::class)]
    private Collection $developers;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Заказчик не может быть пустым.')]
    private ?string $client = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]

    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    #[PositiveOrZero(message: 'Бюджет не может быть отрицательным.')]
    private ?string $budget = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Статус не может быть пустым.')]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Менеджер проекта не может быть пустым.')]
    private ?string $projectManager = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank(message: 'Документы не могут быть пустыми.')]
    private ?string $documents = null;

    #[ORM\Column(length: 20)]
    #[NotBlank(message: 'Приоритет не может быть пустым.')]
    private ?string $priority = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank(message: 'Технологии не могут быть пустыми.')]
    private ?string $technologies = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank(message: 'Заметки не могут быть пустыми.')]
    private ?string $notes = null;

    public function __construct()
    {
        $this->developers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Developer>
     */
    public function getDevelopers(): Collection
    {
        return $this->developers;
    }

    public function addDeveloper(Developer $developer): static
    {
        if (!$this->developers->contains($developer)) {
            $this->developers->add($developer);
            $developer->setProject($this);
        }

        return $this;
    }

    public function removeDeveloper(Developer $developer): static
    {
        if ($this->developers->removeElement($developer)) {

            if ($developer->getProject() === $this) {
                $developer->setProject(null);
            }
        }

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getProjectManager(): ?string
    {
        return $this->projectManager;
    }

    public function setProjectManager(string $projectManager): static
    {
        $this->projectManager = $projectManager;

        return $this;
    }

    public function getDocuments(): ?string
    {
        return $this->documents;
    }

    public function setDocuments(string $documents): static
    {
        $this->documents = $documents;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getTechnologies(): ?string
    {
        return $this->technologies;
    }

    public function setTechnologies(string $technologies): static
    {
        $this->technologies = $technologies;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }
}
