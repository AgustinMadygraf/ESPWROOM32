<?php
// src/Controller/DataController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    #[Route('/automatizacion/get_data', name: 'get_data')]
    public function getData(): JsonResponse
    {
        // Lógica de `get_data_2.php` migrada aquí
        $data = [
            'balanza' => 0, // Valor simulado, reemplaza con lógica real
            'contador' => 0, // Valor simulado, reemplaza con lógica real
        ];

        return new JsonResponse(['error' => false, 'data' => $data]);
    }
}
