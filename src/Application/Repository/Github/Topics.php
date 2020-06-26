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

namespace Veilleur\Application\Repository\Github;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Veilleur\Domain\Model\Github\Topic;
use Veilleur\Domain\Repository\Github\Topics as TopicsInterface;

final class Topics implements TopicsInterface
{
    private ObjectManager $em;
    private ObjectRepository $innerRepository;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
        $this->innerRepository = $registry->getRepository(Topic::class);
    }

    public function findAll(): iterable
    {
        return $this->innerRepository->findAll();
    }

    public function exists(string $text): bool
    {
        return $this->innerRepository->find($text) instanceof Topic;
    }

    public function persist(Topic $topic): void
    {
        $this->em->persist($topic);
    }

    public function remove(Topic $topic): void
    {
        $this->em->remove($topic);
    }

    public function findOneByText(string $text): ?Topic
    {
        return $this->innerRepository->find($text);
    }
}
