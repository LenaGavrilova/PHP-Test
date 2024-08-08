<?php

// src/Controller/ProjectController.php
namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectEditType;
use App\Form\ProjectType;
use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    #[Route('/projects', name: 'project_list', methods: ['GET'])]
    public function index(): Response
    {
        $projects = $this->projectService->getAllProjects();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/project/new', name: 'project_form', methods: ['GET', 'POST'])]
    public function form(Request $request, ?Project $project = null): Response
    {
        if (!$project) {
            $project = new Project();
        }

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projectService->save($project);

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/project/edit/{id}', name: 'project_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request): Response
    {
        $project = $this->projectService->getProject($id);

        if (!$project) {
            throw $this->createNotFoundException('Проект не найден');
        }

        $form = $this->createForm(ProjectEditType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projectService->updateProject();

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }


    #[Route('/project/close/{id}', name: 'close_project')]
    public function closeProject(int $id): Response
    {
        $project = $this->projectService->getProject($id);
        if (!$project) {
            throw $this->createNotFoundException('Проект не найден');
        }

        $this->projectService->closeProject($project);
        $this->addFlash('success', 'Проект успешно закрыт.');
        return $this->redirectToRoute('project_list');
    }

    #[Route('/project/resume/{id}', name: 'project_resume')]
    public function resume(int $id): Response
    {
        $project = $this->projectService->getProject($id);

        if (!$project) {
            throw $this->createNotFoundException('Проект не найден');
        }
        $this->projectService->resumeProject($project);
            $this->addFlash('success', 'Проект успешно возобновлен.');


        return $this->redirectToRoute('project_list');
    }
}

