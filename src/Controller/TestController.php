<?php
// src/Controller/TestController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test-header', name: 'test_header')]
    public function index(): Response
    {
        return $this->render('header/test_header.html.twig'); // Asegúrate de que existe el archivo Twig
    }
}
