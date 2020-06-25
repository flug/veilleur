<?php
declare(strict_types=1);

namespace Veilleur\Domain\Command\Twitter\Account;

class Add
{
    private string $username;
    
    public function __construct(string $username)
    {
        $this->username = $username;
    }
    
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    
}
