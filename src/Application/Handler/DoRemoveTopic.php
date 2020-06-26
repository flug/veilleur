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
use Veilleur\Domain\Command\Github\Topic\Delete;
use Veilleur\Domain\Handler\Github\DoRemoveTopic as DoRemoveTopicInterface;
use Veilleur\Domain\Repository\Github\Topics;

class DoRemoveTopic implements DoRemoveTopicInterface, MessageSubscriberInterface
{
    private Topics $topics;

    public function __construct(Topics $topics)
    {
        $this->topics = $topics;
    }

    public function __invoke(Delete $delete): void
    {
        $this->topics->remove($this->topics->findOneByText($delete->getText()));
    }

    public static function getHandledMessages(): iterable
    {
        yield Delete::class;
    }
}
