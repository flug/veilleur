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

namespace Veilleur\Infrastructure\Github;

use Veilleur\Infrastructure\Github\Trending\Query;

class Client
{
    private Trending\Client $client;
    private \Github\Client $officialClient;

    public function __construct(Trending\Client $client, \Github\Client $officialClient)
    {
        $this->client = $client;
        $this->officialClient = $officialClient;
    }

    public function getRepositories(Query $query)
    {
        return $this->client->getRepositories($query);
    }

    public function getTopics(string $q, string $sort, string $order)
    {
        $query = sprintf('topic:%s', $q);

        return $this->officialClient->search()->repositories($query, $sort, $order)['items'];
    }
}
