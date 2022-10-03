<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\TypeType;

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
    public function editer(TypeType $formulaire, ManagerRegistry $doctrine, int $id, TypeRepository $repository): Response
    {   
        $entityManager = $doctrine->getManager();
        $type = $entityManager->getRepository(Type::class)->find($id);
        $form = $this->createForm($type::class);
        return $this->render('type/editer.html.twig', [
            'controller_name' => 'TypeController',
            'typeForm' => $form->createView(),
        ]);
    }
}
