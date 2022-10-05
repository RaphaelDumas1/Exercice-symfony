<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Competence;
use App\Repository\CompetenceRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CompetenceType;
use Symfony\Component\HttpFoundation\Request;

class CompetenceController extends AbstractController
{
    #[Route('/competence', name: 'competence')]
    public function index(CompetenceRepository $repository): Response
    {   
        $competences = $repository->findAll();
        return $this->render('competence/index.html.twig', [
            'controller_name' => 'CompetenceController',
            'competences' => $competences,
        ]);
    }
    #[Route('/competence/supprimer/{id}', name: 'supprimer_competence')]
    public function supprimer(ManagerRegistry $doctrine, int $id, CompetenceRepository $repository): Response
    {   
        $entityManager = $doctrine->getManager();
        $competence = $entityManager->getRepository(Competence::class)->find($id);
        $entityManager->remove($competence);
        $entityManager->flush();
        return $this->redirectToRoute('competence');
    }
    #[Route('/competence/editer/{id}', name: 'editer_competence')]
    public function editer(Request $request, CompetenceType $formulaire, ManagerRegistry $doctrine, int $id, Competence $competence = null): Response
    {   
        $entityManager = $doctrine->getManager();
        $competence = $entityManager->getRepository(Competence::class)->find($id);
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($competence);
            $entityManager->flush();
        }
        return $this->render('competence/editer.html.twig', [
            'controller_name' => 'TypeController',
            'competenceForm' => $form->createView(),
            'editer' => true,
        ]);
    }
    #[Route('/competence/ajouter/', name: 'ajouter_competence', methods : ['POST', 'GET'])]
    public function ajouter(Request $request, ManagerRegistry $doctrine, Competence $competence = null): Response
    {    
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($competence);
            $entityManager->flush();
            return $this->redirectToRoute('competence');
            
        }
        return $this->render('competence/editer.html.twig', [
            'controller_name' => 'TypeController',
            'competenceForm' => $form->createView(),
            'editer' => false,
        ]);
    }
}
