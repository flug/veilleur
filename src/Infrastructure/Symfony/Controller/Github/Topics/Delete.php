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

namespace Veilleur\Infrastructure\Symfony\Controller\Github\Topics;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * @Route("/github/topics/delete", name="github_delete_topics")
 */
class Delete
{
    private RouterInterface $router;

    private MessageBusInterface $bus;

    public function __construct(RouterInterface $router, MessageBusInterface $bus)
    {
        $this->router = $router;
        $this->bus = $bus;
    }

    public function __invoke(Request $request)
    {
        $this->bus->dispatch(new \Veilleur\Domain\Command\Github\Topic\Delete($request->query->get('query')));

        return new RedirectResponse($this->router->generate('github_topics'));
    }
}
