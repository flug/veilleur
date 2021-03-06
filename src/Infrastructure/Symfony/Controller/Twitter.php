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

namespace Veilleur\Infrastructure\Symfony\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Veilleur\Domain\Command\Twitter\Account\Add as AddAccount;
use Veilleur\Domain\Repository\Twitter\Accounts;
use Veilleur\Infrastructure\Twitter\Client as TwitterClient;

/**
 * @Route("/twitter", name="twitter")
 */
class Twitter
{
    private Environment $twig;

    private MessageBusInterface $bus;

    private RouterInterface $router;

    private Accounts $accounts;

    private TwitterClient $twitterClient;

    public function __construct(
        Environment $twig,
        MessageBusInterface $bus,
        RouterInterface $router,
        Accounts $accounts,
        TwitterClient $twitterClient
    ) {
        $this->twig = $twig;
        $this->bus = $bus;
        $this->router = $router;
        $this->accounts = $accounts;
        $this->twitterClient = $twitterClient;
    }

    public function __invoke(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->bus->dispatch(new AddAccount($request->request->get('username')));

            return new RedirectResponse(
                $this->router->generate('twitter',
                    ['username' => $request->request->get('username')]
                )
            );
        }
        $tweets = [];
        if ($request->query->has('username')) {
            $tweets = $this->twitterClient->getUserTimeline($request->query->get('username'));
        }

        return new Response($this->twig->render('twitter/index.html.twig', [
            'accounts' => $this->accounts->findAll(),
            'tweets' => $tweets,
        ]));
    }
}
