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

namespace Veilleur\Application\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Veilleur\Domain\Model\Twitter\Account;
use Veilleur\Domain\Repository\Twitter\Accounts as AccountsInterface;

final class Accounts implements AccountsInterface
{
    private ObjectManager $em;
    private ObjectRepository $innerRepository;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
        $this->innerRepository = $registry->getRepository(Account::class);
    }

    public function findAll(): iterable
    {
        return $this->innerRepository->findAll();
    }

    public function findOneByUsername(string $username): ?Account
    {
        return $this->innerRepository->find($username);
    }

    public function persist(Account $account): void
    {
        $this->em->persist($account);
    }

    public function remove(?Account $account): void
    {
        $this->em->remove($account);
    }
}
