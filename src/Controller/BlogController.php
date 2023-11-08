<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostChildRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

 #[Route('/blog')]
class BlogController extends AbstractController
{
    #[Route('/', name: 'blog_index')]
    public function index(): Response
    {
        return $this->render('pages/blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

      #[Route('/{id}', name: 'blog_detail')]
    public function detail(int $id,Post $entry ,PostRepository $entryRepository,PostChildRepository $childRepository, SessionInterface $session,EntityManagerInterface $entityManager): Response
    {   
       $viewedPosts = $session->get('viewed_articles', []);

       if(!in_array($entry->getId(), $viewedPosts)) {
        $entry->incrementViewCount();
       $entityManager->persist($entry);
        $entityManager->flush();

        $viewedPosts[] = $entry->getId();
        $session->set('viewed_articles', $viewedPosts);
       }

       $entry = $entryRepository->find($id);
       $children = $childRepository->findByPost($id);
     
       if (!$entry) {
        throw $this->createNotFoundException('The entry post does not exist');
    }
      return $this->render('pages/blog/detail.html.twig', [
        'entry' => $entry,
        'children' => $children
    ]);
    }
}
