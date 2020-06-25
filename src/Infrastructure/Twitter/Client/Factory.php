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

namespace Veilleur\Infrastructure\Twitter\Client;

use Abraham\TwitterOAuth\TwitterOAuth;

class Factory
{
    public static function create(
        string $consumerKey,
        string $consumerSecret,
        string $oauthToken,
        string $oauthTokenSecret
    ): TwitterOAuth {
        return new TwitterOAuth($consumerKey, $consumerSecret, $oauthToken,
            $oauthTokenSecret);
    }
}
