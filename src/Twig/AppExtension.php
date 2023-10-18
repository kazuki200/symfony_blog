<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Symfony\Component\Routing\RouterInterface;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getGlobals(): array
    {
        return [
            'navigation_items' => [
                [
                    'label' => 'Top',
                    'url' => $this->router->generate('top'),
                    'routeName' => 'top'
                ],
                [
                    'label' => 'Blog',
                    'url' => $this->router->generate('blog_index'),
                    'routeName' => 'blog_index'
                ],
                [
                    'label' => 'Contact',
                    'url' => $this->router->generate('contact_index'),
                    'routeName' => 'contact_index'
                ],
                [
                    'label' => 'Sitemap',
                    'url' => $this->router->generate('sitemap_index'),
                    'routeName' => 'sitemap_index'
                ]
            ]
        ];
    }
}