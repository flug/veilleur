<?php
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
