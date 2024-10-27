<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig');
    }

    #[Route('/mantenimiento', name: 'mantenimiento')]
    public function mantenimiento(): Response
    {
        return $this->render('pages/mantenimiento.html.twig');
    }

    #[Route('/electronica', name: 'electronica')]
    public function electronica(): Response
    {
        return $this->render('pages/electronica.html.twig');
    }

    #[Route('/sustentabilidad', name: 'sustentabilidad')]
    public function sustentabilidad(): Response
    {
        return $this->render('pages/sustentabilidad.html.twig');
    }

    #[Route('/oee', name: 'oee')]
    public function oee(): Response
    {
        return $this->render('pages/oee.html.twig');
    }

    #[Route('/manualoperacion', name: 'manualoperacion')]
    public function manualOperacion(): Response
    {
        return $this->render('pages/manualoperacion.html.twig');
    }

    #[Route('/computerVision', name: 'computerVision')]
    public function computerVision(): Response
    {
        return $this->render('pages/computerVision.html.twig');
    }
}
