<?php
declare(strict_types=1);

namespace Veilleur\Domain\Model\Twitter;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    public $username;
    
    public function __construct(string $username)
    {
        $this->username = $username;
    }
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
}
