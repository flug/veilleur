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

namespace Veilleur\Domain\Repository\Github;

use Veilleur\Domain\Model\Github\Topic;

interface Topics
{
    public function findAll(): iterable;

    public function findOneByText(string $text): ?Topic;

    public function exists(string $text): bool;

    public function persist(Topic $topic);

    public function remove(Topic $topic);
}
