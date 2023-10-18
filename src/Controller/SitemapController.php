<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap', name: 'sitemap_index')]
    public function index(): Response
    {
        return $this->render('pages/sitemap/index.html.twig', [
            'controller_name' => 'SitemapController',
        ]);
    }
}
