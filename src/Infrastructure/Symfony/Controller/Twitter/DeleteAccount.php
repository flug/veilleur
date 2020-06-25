<?php
declare(strict_types=1);

namespace Veilleur\Infrastructure\Symfony\Controller\Twitter;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Veilleur\Domain\Command\Twitter\Account\Delete;
use Veilleur\Domain\Repository\Twitter\Accounts;

/**
 * @Route("/twitter/delete-account", name="delete_account")
 */
class DeleteAccount
{
    /**
     * @var Accounts
     */
    private Accounts $accounts;
    /**
     * @var RouterInterface
     */
    private RouterInterface $router;
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $bus;
    
    public function __construct(Accounts $accounts, RouterInterface $router, MessageBusInterface $bus)
    {
        $this->accounts = $accounts;
        $this->router = $router;
        $this->bus = $bus;
    }
    
    public function __invoke(Request $request)
    {
        
        $this->bus->dispatch(new Delete($request->query->get('username')));
        
        return new RedirectResponse($this->router->generate('twitter'));
    }
}
