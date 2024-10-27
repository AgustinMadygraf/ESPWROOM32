<?php
// src/Controller/GetData2Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class GetData2Controller extends AbstractController
{
    /**
     * @Route("/automatizacion/get_data", name="get_data")
     */
    public function getData(LoggerInterface $logger): JsonResponse
    {
        try {
            // Lógica de `get_data_2.php` migrada aquí
            $data = [
                'balanza' => 0, // Valor simulado, reemplaza con lógica real
                'contador' => 0, // Valor simulado, reemplaza con lógica real
            ];
            return new JsonResponse(['error' => false, 'data' => $data]);
        } catch (\Exception $e) {
            $logger->error("Error en GetData2Controller: " . $e->getMessage());
            return new JsonResponse(['error' => true, 'message' => 'Error al obtener los datos.']);
        }
    }
}