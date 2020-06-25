<?php
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
