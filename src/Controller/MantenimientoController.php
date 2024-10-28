<?php
// src/Controller/MantenimientoController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Parsedown;

class MantenimientoController extends AbstractController
{
    public function index(): Response
    {
        $parsedown = new Parsedown();
        $markdownContent = file_get_contents($this->getParameter('kernel.project_dir') . '/docs/mantenimiento.md');
        $htmlContent = $parsedown->text($markdownContent);

        return $this->render('pages/mantenimiento.html.twig', [
            'markdown_content' => $htmlContent,
        ]);
    }
}
