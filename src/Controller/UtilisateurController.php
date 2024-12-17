<?php

namespace App\Controller;

use App\Repository\FoyerRepository;
use App\Repository\ChambreRepository;
use App\Repository\DemandeSelectionRepository;
use App\Repository\TrajetRepository;
use App\Repository\VehiculeRepository;
use App\Entity\DemandeSelection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(FoyerRepository $foyerRepository, ChambreRepository $chambreRepository,TrajetRepository $trajetRepository, VehiculeRepository $vehiculeRepository): Response
    {
        $foyers = $foyerRepository->findAll();
        $chambres = $chambreRepository->findAll();

        $trajets = $trajetRepository->findAll();
        $vehicules = $vehiculeRepository->findAll();


        return $this->render('utilisateur.html.twig', [
            'foyers' => $foyers,
            'chambres' => $chambres,
            'trajets' => $trajets,
            'vehicules' => $vehicules,
        ]);
    }

    #[Route('/utilisateur/selectionner-chambre', name: 'app_selectionner_chambre', methods: ['POST'])]
    public function selectionnerChambre(
        Request $request,
        ChambreRepository $chambreRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $chambreId = $request->request->get('chambre_id');
        
        $chambre = $chambreRepository->find($chambreId);

        if (!$chambre) {
            $this->addFlash('error', 'Chambre non trouvée.');
            return $this->redirectToRoute('app_utilisateur');
        }

        $foyer = $chambre->getFoyer();

        if (!$foyer) {
            $this->addFlash('error', 'Le foyer associé à cette chambre n\'est pas trouvé.');
            return $this->redirectToRoute('app_utilisateur');
        }



        $demande = new DemandeSelection();
        $demande->setChambre($chambre);
        $demande->setFoyer($foyer); 
        $demande->setDateDemande(new \DateTime());
        $demande->setStatut('En attente');

        $entityManager->persist($demande);
        $entityManager->flush();

        $this->addFlash('successs', 'Votre demande de sélection a été soumise avec succès.');

        return $this->redirectToRoute('app_utilisateur');
    }
}
