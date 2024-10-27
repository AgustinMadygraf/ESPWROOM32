<?php
// src/Controller/GetData2Controller.php
namespace App\Controller;

use App\Services\DataFetcher;
use App\Services\ConfigChecker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class GetData2Controller extends AbstractController
{
    /**
     * @Route("/automatizacion/get_data", name="get_data")
     */
    public function getData(LoggerInterface $logger, ConfigChecker $configChecker, DataFetcher $dataFetcher): JsonResponse
    {
        try {
            if (!$configChecker->check()) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Falta el archivo de configuración',
                    'details' => 'El archivo .env no se encuentra en la ruta esperada. Redirigiendo a la instalación.'
                ]);
            }

            $data = $dataFetcher->fetchLatestData();

            return new JsonResponse(['error' => false, 'data' => $data]);
        } catch (\Exception $e) {
            $logger->error("Error en GetData2Controller: " . $e->getMessage());
            return new JsonResponse([
                'error' => true,
                'message' => 'Error al obtener los datos.',
                'details' => $e->getMessage()
            ]);
        }
    }
}
