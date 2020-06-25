<?php
declare(strict_types=1);

namespace Veilleur\Application\Handler;

use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Veilleur\Domain\Command\Twitter\Account\Delete;
use Veilleur\Domain\Handler\Twitter\DoRemoveAccount as DoRemoveAccountInterface;
use Veilleur\Domain\Repository\Twitter\Accounts;

class DoRemoveAccount implements DoRemoveAccountInterface, MessageSubscriberInterface
{
    /**
     * @var Accounts
     */
    private Accounts $accounts;
    
    public function __construct(Accounts $accounts)
    {
        $this->accounts = $accounts;
    }
    
    public function __invoke(Delete $delete)
    {
        
        $account = $this->accounts->findOneByUsername($delete->getUsername());
        $this->accounts->remove($account);
        
    }
    
    public static function getHandledMessages(): iterable
    {
        yield Delete::class;
    }
}
