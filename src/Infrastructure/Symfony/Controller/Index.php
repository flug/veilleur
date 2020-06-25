<?php
declare(strict_types=1);

namespace Veilleur\Infrastructure\Symfony\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/")
 */
class Index
{
    /**
     * @var Environment
     */
    private Environment $twig;
    
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    
    public function __invoke()
    {
        return new Response($this->twig->render('index.html.twig'));
    }
}
