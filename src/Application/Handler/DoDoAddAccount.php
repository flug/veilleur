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

namespace Veilleur\Application\Handler;

use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Veilleur\Domain\Command\Twitter\Account\Add as AddAccount;
use Veilleur\Domain\Handler\Twitter\DoAddAccount as AddAccountInterface;
use Veilleur\Domain\Repository\Twitter\Accounts as AccountsRepository;

class DoDoAddAccount implements AddAccountInterface, MessageSubscriberInterface
{
    private AccountsRepository $accounts;

    public function __construct(AccountsRepository $accounts)
    {
        $this->accounts = $accounts;
    }

    public function __invoke(AddAccount $accountCommand)
    {
        $account = $this->accounts->findOneByUsername($accountCommand->getUsername());
        if ($account instanceof \Veilleur\Domain\Model\Twitter\Account) {
            return;
        }
        $account = new \Veilleur\Domain\Model\Twitter\Account($accountCommand->getUsername());
        $this->accounts->persist($account);
    }

    public static function getHandledMessages(): iterable
    {
        yield AddAccount::class;
    }
}
