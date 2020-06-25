<?php
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
