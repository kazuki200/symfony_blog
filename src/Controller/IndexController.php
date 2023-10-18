<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'top')]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('pages/index/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }
}
