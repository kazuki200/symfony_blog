<?php
namespace App\Twig;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Symfony\Component\Routing\RouterInterface;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    private $router;
    private $categoryRepository;
    private $requestStack;

    public function __construct(RouterInterface $router, CategoryRepository $categoryRepository, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->categoryRepository = $categoryRepository;
        $this->requestStack = $requestStack;
    }

    public function getGlobals(): array
{
    $categories = $this->categoryRepository->findByStatusTrue();
    
    $categoryNavItems = array_map(function($category) {
        return [
            'label' => $category->getName(),
            'url' => $this->router->generate('blog_index', ['category' => $category->getName()]),
            'path' => '/blog/?category='.$category
        ];
    }, $categories);

    // 'Top' のみを最初に配置
    $baseNavItemsStart = [
        [
            'label' => 'Top',
            'url' => $this->router->generate('top'),
            'path' => '/'
        ],
    ];
    
    // 'Contact' のみを最後に配置
    $baseNavItemsEnd = [
        [
            'label' => 'Contact',
            'url' => $this->router->generate('contact_index'),
            'path' => '/contact'
        ],
    ];

    return [
        'navigation_items' => array_merge($baseNavItemsStart, $categoryNavItems, $baseNavItemsEnd),
    ];
}

}