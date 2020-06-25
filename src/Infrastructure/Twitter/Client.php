<?php
declare(strict_types=1);

namespace Veilleur\Infrastructure\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

class Client
{
    private $auth;
    
    public function __construct(TwitterOAuth $auth)
    {
        $this->auth = $auth;
        $this->auth->setTimeouts(20, 50);
    }
    
    public function send(array $message, ?string $image = null)
    {
        if ($image !== null) {
            $message = array_merge($this->uploadMedia($image), $message);
        }
        
        return $this->auth->post("statuses/update", $message);
    }
    
    private function uploadMedia(string $path = null): ?array
    {
        if ($path === null) {
            return null;
        }
        $mediaPath = $path;
        $readmeMedia = (array)$this->auth->upload('media/upload',
            ['media' => $mediaPath]);
        
        return ['media_ids' => [$readmeMedia['media_id_string']]];
    }
    
    public function verify()
    {
        return (array)$this->auth->get("account/verify_credentials");
        
    }
    
    public function findAUser(
        string $name
    ): ?array {
        $response = $this->auth->get('users/search', [
            'q' => strtr(strtolower($name), [' ' => '%20']),
            'include_entities' => true,
            'count' => 20,
        ]);
        foreach ($response as $user) {
            if (property_exists($user->entities, 'url')) {
                foreach ($user->entities->url->urls as $url) {
                    if (!property_exists($url, 'display_url')) {
                        return [];
                    }
                    if ((bool)strpos($url->display_url, 'github') === true) {
                        return (array)$user;
                    }
                }
            }
        }
        
        return [];
    }
    
    public function lastPossibilityUser(string $name)
    {
        $response = $this->auth->get('users/search', [
            'q' => strtr($name, [' ' => '%20']),
        ]);
        
        return (array)current($response);
    }
    
    public function getLookUp(string $name)
    {
        $response = $this->auth->get('users/lookup', [
            'screen_name' => $name,
        ]);
        
        return (array)$response;
    }
    
    public function getUserTimeline(string $username)
    {
        
        $response = $this->auth->get('statuses/user_timeline', [
            'screen_name' => $username,
            'tweet_mode'=>'extended',
            'include_entities' => true
        ]);
        
        return (array)$response;
    }
    
    public function isConnected(): bool
    {
        return !array_key_exists('errors', $this->verify());
    }
}
