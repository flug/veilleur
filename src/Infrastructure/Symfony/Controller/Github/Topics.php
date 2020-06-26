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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Veilleur\Domain\Command\Github\Topic;
use Veilleur\Infrastructure\Github\Client;

/**
 * @Route("/github/topics", name="github_topics")
 */
class Topics
{
    private Environment $twig;
    private Client $client;
    private \Veilleur\Domain\Repository\Github\Topics $topics;
    private MessageBusInterface $bus;
    private RouterInterface $router;

    public function __construct(
        Environment $twig,
        Client $client,
        \Veilleur\Domain\Repository\Github\Topics $topics,
        MessageBusInterface $bus,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->client = $client;
        $this->topics = $topics;
        $this->bus = $bus;
        $this->router = $router;
    }

    public function __invoke(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->bus->dispatch(new Topic($request->request->get('query')));

            return new RedirectResponse($this->router->generate('github_topics',
                ['query' => $request->request->get('query')])
            );
        }
        $query = $request->query->get('query', $request->query->get('language', ''));
        if (!empty($request->query->get('language')) && $request->query->has('query')) {
            $query = $request->query->get('query', '').'+'.$request->query->get('language');
        }

        $repositories = $this->client->getTopics(
            $query,
            $request->query->get('s', 'updated'),
            $request->query->get('o', 'asc')
        );

        return new Response($this->twig->render('github/topics.html.twig', [
            'repositories' => $repositories,
            'topics' => $this->topics->findAll(),
        ]));
    }
}
