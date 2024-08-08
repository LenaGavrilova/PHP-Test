<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Этот email уже используется.')]
class Developer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'ФИО не может быть пустым.')]
    #[Length(
        max: 255,
        maxMessage: 'ФИО не может превышать {{ limit }} символов.'
    )]
    private ?string $fullName = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Должность не может быть пустой.')]
    #[Length(
        max: 255,
        maxMessage: 'Должность не может превышать {{ limit }} символов.'
    )]
    private ?string $position = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Email не может быть пустым.')]
    #[Email(message: 'Введите корректный email.')]
    #[Length(
        max: 255,
        maxMessage: 'Email не может превышать {{ limit }} символов.'
    )]
    private ?string $email = null;

    #[ORM\Column(length: 15)]
    #[NotBlank(message: 'Контактный телефон не может быть пустым.')]
    #[Length(
        max: 20,
        maxMessage: 'Номер телефона не может превышать {{ limit }} символов.'
    )]
    private ?string $phoneNumber = null;

    #[ORM\ManyToOne(inversedBy: 'developers')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotNull(message: 'Проект не может быть пустым.')]
    private ?Project $project = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank(message: 'Навыки не могут быть пустыми.')]
    private ?string $skills = null;

    #[ORM\Column]
    #[PositiveOrZero(message: 'Опыт работы не может быть отрицательным числом.')]
    private ?int $experienceYears = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $hireDate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 1)]
    #[Positive(message: 'Зарплата должна быть положительным числом.')]
    private ?string $salary = null;

    #[ORM\Column(length: 50)]
    #[NotBlank(message: 'Статус не может быть пустым.')]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    #[NotBlank(message: 'Адрес не может быть пустым.')]
    private ?string $address = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank(message: 'Заметки не может быть пустым.')]
    private ?string $notes = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }


    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): static
    {
        $this->skills = $skills;

        return $this;
    }

    public function getExperienceYears(): ?int
    {
        return $this->experienceYears;
    }

    public function setExperienceYears(int $experienceYears): static
    {
        $this->experienceYears = $experienceYears;

        return $this;
    }

    public function getHireDate(): ?\DateTimeInterface
    {
        return $this->hireDate;
    }

    public function setHireDate(\DateTimeInterface $hireDate): static
    {
        $this->hireDate = $hireDate;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): static
    {
        $this->salary = $salary;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

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
