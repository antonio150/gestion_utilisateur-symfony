<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'page_accueil', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('accueil/index.html.twig');
    }
}
