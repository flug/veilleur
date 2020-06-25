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

namespace Veilleur\Infrastructure\Github\Trending;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getRepositories(Query $query)
    {
        $response = $this->client->request('GET', '/repositories', [
            'query' => $query->toArray(),
        ]);

        return $response->toArray();
    }
}
