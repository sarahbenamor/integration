<?php

namespace App\Controller;

use App\Entity\Personnelle;
use App\Form\PersonnelleType;
use App\Repository\PersonnelleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personnelle')]
class PersonnelleController extends AbstractController
{
    #[Route('/', name: 'app_personnelle_index', methods: ['GET'])]
    public function index(PersonnelleRepository $personnelleRepository): Response
    {
        return $this->render('personnelle/index.html.twig', [
            'personnelles' => $personnelleRepository->findAll(),
        ]);
    }

    #[Route('/add', name: 'app_personnelle_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager,PersonnelleRepository $personnelleRepository): Response
    {
        $personnelle = new Personnelle();
        $form = $this->createForm(PersonnelleType::class, $personnelle);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($personnelle);
            $entityManager->flush();
    
            $this->addFlash('success', 'Personnelle added successfully!');
            return $this->redirectToRoute('app_personnelle_add');
        }
    
        return $this->render('personnelle/index.html.twig', [
            'form' => $form->createView(),  
            'personnelles' => $personnelleRepository->findAll(),
        ]);
    }
    #[Route('/edit/{id}', name: 'app_personnelle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Personnelle $personnelle, EntityManagerInterface $entityManager,PersonnelleRepository $personnelleRepository): Response
    {
        $form = $this->createForm(PersonnelleType::class, $personnelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Personnelle updated successfully!');
            return $this->redirectToRoute('app_personnelle_add');
        }

        return $this->render('personnelle/edit.html.twig', [
            'form' => $form->createView(),
            'personnelle' => $personnelle,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_personnelle_delete', methods: ['POST'])]
    public function delete(Request $request, Personnelle $personnelle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $personnelle->getId(), $request->request->get('_token'))) {
            $entityManager->remove($personnelle);
            $entityManager->flush();

            $this->addFlash('success', 'Personnelle deleted successfully!');
        }
       

        return  $this->redirectToRoute('app_personnelle_add');
    }

    #[Route('/index', name: 'app_personnelle_table', methods: ['GET'])]
    public function tableView(PersonnelleRepository $personnelleRepository): Response
    {
        return $this->render('personnelle/index.html.twig', [
            'personnelles' => $personnelleRepository->findAll(),
           
        ]);
    }
}
