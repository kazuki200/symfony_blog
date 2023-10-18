<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search_index')]
    public function index(): Response
    {
        return $this->render('pages/search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
