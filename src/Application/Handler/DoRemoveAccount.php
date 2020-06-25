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
use Veilleur\Domain\Command\Twitter\Account\Delete;
use Veilleur\Domain\Handler\Twitter\DoRemoveAccount as DoRemoveAccountInterface;
use Veilleur\Domain\Repository\Twitter\Accounts;

class DoRemoveAccount implements DoRemoveAccountInterface, MessageSubscriberInterface
{
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
