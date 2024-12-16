<?php

namespace App\Controller;

use App\Repository\TrajetRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardTransportController extends AbstractController
{
    private $trajetRepository;
    private $vehiculeRepository;

    public function __construct(TrajetRepository $trajetRepository, VehiculeRepository $vehiculeRepository)
    {
        $this->trajetRepository = $trajetRepository;
        $this->vehiculeRepository = $vehiculeRepository;
    }

    #[Route('/dashboard_transport', name: 'dashboardTransport')]
    public function index(Request $request)
    {
        $trajets = $this->trajetRepository->findAll();
        $vehicules = $this->vehiculeRepository->findAll();

        return $this->render('dashboardTransport.html.twig', [
            'trajets' => $trajets,
            'vehicules' => $vehicules,
        ]);
    }
}
