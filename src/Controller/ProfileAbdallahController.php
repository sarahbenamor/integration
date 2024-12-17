<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileAbdallahController extends AbstractController
{
    #[Route('/profileabdallah', name: 'profileabdallah')]
    public function index(): Response
    {
        return $this->render('/profilabdallah/profilabdallah.html.twig');

    }
}
