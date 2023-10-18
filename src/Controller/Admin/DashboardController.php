<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\Category;
use App\Entity\Comment;
// use App\Entity\PostTag;
use App\Entity\Tag;
use App\Controller\Admin\PostCrudController;



class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
       return $this->redirect($adminUrlGenerator->setController(PostCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTranslationDomain("")
            ->setTitle('Symfony Blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud("Post","fa fa-blog", Post::class);
        yield MenuItem::linkToCrud("Comment","fa fa-comment", Comment::class);
        yield MenuItem::linkToCrud("Category","fa fa-file", Category::class);
        yield MenuItem::linkToCrud("Tag","fa fa-tag", Tag::class);
    }
}
