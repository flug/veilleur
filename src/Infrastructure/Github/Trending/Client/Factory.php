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

namespace Veilleur\Infrastructure\Github\Trending\Client;

use Symfony\Component\HttpClient\NativeHttpClient;

final class Factory
{
    private const BASE_URI = 'https://ghapi.huchen.dev';

    public static function create()
    {
        $defaultOptions['base_uri'] = self::BASE_URI;

        return new NativeHttpClient($defaultOptions);
    }
}
