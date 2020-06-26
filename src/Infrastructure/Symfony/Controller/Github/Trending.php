<?php

/*
 * This file is part of the Veilleur project.
 *
 * (c) Lemay Marc <flugv1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Veilleur\Infrastructure\Symfony\Controller\Github;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Veilleur\Infrastructure\Github\Client;
use Veilleur\Infrastructure\Github\Trending\Query;

/**
 * @Route("/github/trending", name="github_trending")
 */
class Trending
{
    private Environment $twig;

    private Client $client;

    public function __construct(Environment $twig, Client $client)
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
