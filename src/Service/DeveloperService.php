<?php

namespace App\Service;

use App\Entity\Developer;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeveloperService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function hireDeveloper(
       Developer $developer
    ): Developer {
        $developer->setFullName($developer->getFullName());
        $developer->setPosition($developer->getPosition());
        $developer->setEmail($developer->getEmail());
        $developer->setPhoneNumber($developer->getPhoneNumber());
        $developer->setProject($developer->getProject());
        $developer->setBirthday($developer->getBirthday());
        $developer->setSkills($developer->getSkills());
        $developer->setExperienceYears($developer->getExperienceYears());
        $developer->setHireDate($developer->getHireDate());
        $developer->setSalary($developer->getSalary());
        $developer->setStatus($developer->getStatus());
        $developer->setAddress($developer->getAddress());
        $developer->setNotes($developer->getNotes());

        $this->entityManager->persist($developer);
        $this->entityManager->flush();

        return $developer;
    }

    public function fireDeveloper(Developer $developer): void
    {
        $developer->setStatus("fired");
        $this->entityManager->flush();
    }

    public function updateDeveloper()
    {

        $this->entityManager->flush();

    }

    public function updateStatus(Developer $developer,string $status)
    {
        $developer->setStatus($status);
        $this->entityManager->flush();

    }

    public function getDeveloper(int $developerId): ?Developer
    {
        $developer = $this->entityManager->getRepository(Developer::class)->find($developerId);
        if (!$developer){
            return null;
        }
        return $developer;
    }

    public function getAllDevelopers()
    {
        return $this->entityManager->getRepository(Developer::class)->findAll();
    }
}
