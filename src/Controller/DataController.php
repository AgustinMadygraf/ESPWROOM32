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
        // Aquí colocas la lógica real para obtener los datos.
        // Ejemplo de valores simulados:
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
