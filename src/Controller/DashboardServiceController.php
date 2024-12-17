<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Repository\PersonnelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Service;
use App\Entity\Personnelle;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Routing\Annotation\Route;


class DashboardServiceController extends AbstractController
{
    #[Route('/dashboardService', name: 'dashboardService')]
    public function index(ServiceRepository $ServiceRepository): Response
    {
        $services = $ServiceRepository->findAll();

        return $this->render('/dashboard_service/dashboardabdallah.html.twig',[
            'services'=> $services,
        ]);
    }

#[Route('/dashboard_service/export/pdf', name: 'dashboard_export_pdf')]
public function exportPdf(EntityManagerInterface $entityManager): Response
{
    // Récupérer les services depuis le repository
    $services = $entityManager->getRepository(Service::class)->findAll();

    // Initialisation pour éviter une erreur sur $personnelles
    $personnelles = [];

    // Configuration de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // Générer le HTML avec Twig
    $html = $this->renderView('/dashboard_service/services.html.twig', [
        'services' => $services,
        'personnelles' => $personnelles,
    ]);

    // Charger et rendre le HTML avec Dompdf
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("Liste_Service_Personnelle.pdf", ["Attachment" => true]);
    
    return new Response();
}

}
