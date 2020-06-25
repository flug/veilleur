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

class Query
{
    private array $query;

    public function __construct()
    {
        $this->query = [];
    }

    public function setLanguage(string $language)
    {
        $this->query['language'] = $language;

        return $this;
    }

    public function since(string $since)
    {
        $this->query['since'] = $since;

        return $this;
    }

    public static function fromRequest(?string $language = null, ?string $since = null)
    {
        $query = new self();
        if (null !== $language) {
            $query->setLanguage($language);
        }
        if (null !== $since) {
            $query->since($since);
        }

        return $query;
    }

    public function toArray()
    {
        return $this->query;
    }
}
