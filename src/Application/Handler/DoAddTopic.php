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
use Veilleur\Domain\Command\Github\Topic;
use Veilleur\Domain\Handler\Github\DoAddTopic as DoAddTopicInterface;
use Veilleur\Domain\Repository\Github\Topics;

class DoAddTopic implements DoAddTopicInterface, MessageSubscriberInterface
{
    private Topics $topics;

    public function __construct(Topics $topics)
    {
        $this->topics = $topics;
    }

    public function __invoke(Topic $topic): void
    {
        if ($this->topics->exists($topic->getText())) {
            return;
        }
        $this->topics->persist(new \Veilleur\Domain\Model\Github\Topic($topic->getText()));
    }

    public static function getHandledMessages(): iterable
    {
        yield Topic::class;
    }
}
