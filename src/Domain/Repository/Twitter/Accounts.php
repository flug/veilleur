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

namespace Veilleur\Domain\Repository\Twitter;

use Veilleur\Domain\Model\Twitter\Account;

interface Accounts
{
    public function findOneByUsername(string $username): ?Account;

    public function findAll(): iterable;

    public function persist(Account $account): void;

    public function remove(?Account $account);
}
