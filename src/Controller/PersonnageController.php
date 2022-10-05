<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personnage;
use App\Repository\PersonnageRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\PersonnageType;
use Symfony\Component\HttpFoundation\Request;

class PersonnageController extends AbstractController
{
    #[Route('/personnage', name: 'personnage')]
    public function index(PersonnageRepository $repository): Response
    {   
        $personnages = $repository->findAll();
        return $this->render('personnage/index.html.twig', [
            'controller_name' => 'PersonnageController',
            'personnages' => $personnages,
        ]);
    }
    #[Route('/personnage/supprimer/{id}', name: 'supprimer_personnage')]
    public function supprimer(ManagerRegistry $doctrine, int $id, PersonnageRepository $repository): Response
    {   
        $entityManager = $doctrine->getManager();
        $personnage = $entityManager->getRepository(Personnage::class)->find($id);
        $entityManager->remove($personnage);
        $entityManager->flush();
        return $this->redirectToRoute('personnage');
    }
    #[Route('/personnage/editer/{id}', name: 'editer_personnage')]
    public function editer(Request $request, PersonnageType $formulaire, ManagerRegistry $doctrine, int $id, Personnage $personnage = null): Response
    {   
        $entityManager = $doctrine->getManager();
        $personnage = $entityManager->getRepository(Personnage::class)->find($id);
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($personnage);
            $entityManager->flush();
        }
        return $this->render('personnage/editer.html.twig', [
            'controller_name' => 'TypeController',
            'personnageForm' => $form->createView(),
            'editer' => true,
        ]);
    }
    #[Route('/personnage/ajouter/', name: 'ajouter_personnage', methods : ['POST', 'GET'])]
    public function ajouter(Request $request, ManagerRegistry $doctrine, Personnage $personnage = null): Response
    {    
        $personnage = new Personnage();
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($personnage);
            $entityManager->flush();
            return $this->redirectToRoute('personnage');
            
        }
        return $this->render('personnage/editer.html.twig', [
            'controller_name' => 'TypeController',
            'personnageForm' => $form->createView(),
            'editer' => false,
        ]);
    }
}
