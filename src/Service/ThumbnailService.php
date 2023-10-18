<?php 
namespace App\Service;

use Symfony\Component\Routing\RouterInterface;

class ThumbnailService
{
    private $router;
    private $basePath;

    public function __construct(RouterInterface $router, string $basePath)
    {
        $this->router = $router;
        $this->basePath = $basePath; // 例：'uploads/images/'
    }

    public function getThumbnailUrl(string $filename): string
    {
        return $this->router->getContext()->getBaseUrl() . '/' . $this->basePath . $filename;
    }
}
