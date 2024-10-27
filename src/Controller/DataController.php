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
        // Validar la existencia del archivo .env
        $envFileExists = file_exists($this->getParameter('kernel.project_dir').'/.env');
        if (!$envFileExists) {
            return new JsonResponse([
                'error' => true,
                'message' => 'Falta el archivo .env, redireccionando...',
                'redirect' => '/automatizacion/setup/install.php'
            ]);
        }

        // Lógica simulada para obtener datos
        $data = [
            'balanza' => 100.25, // Reemplaza con el valor real
            'contador' => 42,    // Reemplaza con el valor real
        ];

        // Validación de errores, ejemplo
        if (/* condición para error */ false) {
            return new JsonResponse([
                'error' => true,
                'message' => 'Descripción del error',
                'details' => 'Detalles adicionales, si aplica',
            ]);
        }

        // Respuesta exitosa
        return new JsonResponse([
            'error' => false,
            'data' => $data
        ]);
    }
}