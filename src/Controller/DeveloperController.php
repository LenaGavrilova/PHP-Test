<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Entity\Project;
use App\Form\DeveloperEditType;
use App\Form\DeveloperType;
use App\Service\DeveloperService;
use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeveloperController extends AbstractController
{
    private DeveloperService $developerService;
    private ProjectService $projectService;

    public function __construct(DeveloperService $developerService, ProjectService $projectService)
    {
        $this->developerService = $developerService;
        $this->projectService = $projectService;
    }


    #[Route('/developers', name: 'developer_list', methods: ['GET'])]
    public function index(): Response
    {
        $developers = $this->developerService->getAllDevelopers();

        return $this->render('developer/index.html.twig', [
            'developers' => $developers,
        ]);
    }
    #[Route('/developer/fire/{id}', name: 'fire_developer')]
    public function fireDeveloper(int $id): Response
    {
        $developer = $this->developerService->getDeveloper($id);
        if (!$developer) {
            throw $this->createNotFoundException('Разработчик не найден');
        }

        $this->developerService->fireDeveloper($developer);

        return new Response('Developer fired.');

    }

    #[Route('/developer/new', name: 'developer_form', methods: ['GET', 'POST'])]
    public function hireDeveloper(Request $request, ?Developer $developer = null): Response
    {
        if (!$developer) {
            $developer = new Developer();
        }

        $form = $this->createForm(DeveloperType::class, $developer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->developerService->hireDeveloper($developer);

            return $this->redirectToRoute('developer_list');
        }

        return $this->render('developer/form.html.twig', [
            'form' => $form->createView(),
            'developer' => $developer,
        ]);
    }

    #[Route('/developer/edit/{id}', name: 'developer_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request): Response
    {
        $developer = $this->developerService->getDeveloper($id);

        if (!$developer) {
            throw $this->createNotFoundException('Разработчик не найден');
        }

        $form = $this->createForm(DeveloperEditType::class, $developer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->developerService->updateDeveloper();

            return $this->redirectToRoute('developer_list');
        }

        return $this->render('developer/edit.html.twig', [
            'form' => $form->createView(),
            'developer' => $developer,
        ]);
    }
    #[Route('/developer/set-status/{id}/{status}', name: 'developer_set_status')]
    public function setStatus(int $id, string $status,): Response
    {
        $developer = $this->developerService->getDeveloper($id);

        if (!$developer) {
            throw $this->createNotFoundException('Developer not found');
        }

        $this->developerService->updateStatus($developer,$status);

        $this->addFlash('success', 'Developer status updated successfully.');

        return $this->redirectToRoute('developer_list');
    }

}
