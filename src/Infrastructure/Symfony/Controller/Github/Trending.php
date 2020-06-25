<?php
declare(strict_types=1);

namespace Veilleur\Infrastructure\Symfony\Controller\Github;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Veilleur\Infrastructure\Github\Trending\Client as TrendingClient;
use Veilleur\Infrastructure\Github\Trending\Query;

/**
 * @Route("/github/trending" , name="github_trending")
 */
class Trending
{
    /**
     * @var Environment
     */
    private Environment $twig;
    /**
     * @var TrendingClient
     */
    private TrendingClient $client;
    
    public function __construct(Environment $twig, TrendingClient $client)
    {
        $this->twig = $twig;
        $this->client = $client;
    }
    
    public function __invoke(Request $request)
    {
        $repositories = $this->client->getRepositories(
            Query::fromRequest(
                $request->query->get('language'),
                $request->query->get('since')
            )
        );
        
        return new Response($this->twig->render('github/trending.html.twig', [
            'repositories' => $repositories,
        ]));
    }
}
