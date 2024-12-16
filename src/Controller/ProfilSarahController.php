<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilSarahController extends AbstractController
{
    #[Route('/profil/sarah', name: 'app_profil_sarah')]
    public function index(): Response
    {
        return $this->render('profilsarah.html.twig', [
            'controller_name' => 'ProfilSarahController',
        ]);
    }
}
