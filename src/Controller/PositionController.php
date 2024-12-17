<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PositionController extends AbstractController
{
        #[Route('/vehicule/map', name: 'vehicule_map')]
    public function map(): Response
{
    $googleMapsApiKey = 'AIzaSyC06ky_8t7h7kTrhIdUBwXC9vCnsvXlX7E';
    return $this->render('vehicule/map.html.twig', [
        'google_maps_api_key' => $googleMapsApiKey,
    ]);;
}
}
