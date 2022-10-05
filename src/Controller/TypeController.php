<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\TypeType;
use Symfony\Component\HttpFoundation\Request;

class TypeController extends AbstractController
{
    #[Route('/type', name: 'type')]
    public function index(TypeRepository $repository): Response
    {
        $types = $repository->findAll();
        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
            'types' => $types,
        ]);
    }
    #[Route('/type/supprimer/{id}', name: 'supprimer_type')]
    public function supprimer(ManagerRegistry $doctrine, int $id, TypeRepository $repository): Response
    {   
        $entityManager = $doctrine->getManager();
        $type = $entityManager->getRepository(Type::class)->find($id);
        $entityManager->remove($type);
        $entityManager->flush();
        return $this->redirectToRoute('type');
    }
    #[Route('/type/editer/{id}', name: 'editer_type')]
    public function editer(Request $request, TypeType $formulaire, ManagerRegistry $doctrine, int $id, Type $type = null): Response
    {   
        $entityManager = $doctrine->getManager();
        $type = $entityManager->getRepository(Type::class)->find($id);
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($type);
            $entityManager->flush();
        }
        return $this->render('type/editer.html.twig', [
            'controller_name' => 'TypeController',
            'typeForm' => $form->createView(),
            'editer' => true,
        ]);
    }
    #[Route('/type/ajouter/', name: 'ajouter_type', methods : ['POST', 'GET'])]
    public function ajouter(Request $request, ManagerRegistry $doctrine, Type $type = null): Response
    {    
        $type = new Type();
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($type);
            $entityManager->flush();
            return $this->redirectToRoute('type');

        }
        return $this->render('type/editer.html.twig', [
            'controller_name' => 'TypeController',
            'typeForm' => $form->createView(),
            'editer' => false,
        ]);
    }
}
