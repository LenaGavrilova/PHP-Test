<?php

namespace App\Service;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

class ProjectService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(
        Project $project
    ): Project {

        $project->setName($project->getName());
        $project->setClient($project->getClient());
        $project->setStartDate($project->getStartDate());
        $project->setEndDate($project->getEndDate());
        $project->setBudget($project->getBudget());
        $project->setStatus($project->getStatus());
        $project->setDescription($project->getDescription());
        $project->setProjectManager($project->getProjectManager());
        $project->setDocuments($project->getDocuments());
        $project->setPriority($project->getPriority());
        $project->setTechnologies($project->getTechnologies());
        $project->setNotes($project->getNotes());

        $this->entityManager->persist($project);
        $this->entityManager->flush();

        return $project;
    }

    public function closeProject(Project $project): void
    {
        $project->setStatus('completed');
        $this->entityManager->flush();
    }

    public function resumeProject(Project $project): void
    {
        $project->setStatus('in progress');
        $this->entityManager->flush();
    }

    public function updateProject()
    {

        $this->entityManager->flush();

    }

    public function getProject(int $projectId): ?Project
    {
        $project = $this->entityManager->getRepository(Project::class)->find($projectId);
        if (!$project){
            return null;
        } return $project;
    }

    public function getAllProjects()
    {
        return $this->entityManager->getRepository(Project::class)->findAll();
    }
}
