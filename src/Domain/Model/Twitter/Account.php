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

namespace Veilleur\Domain\Model\Twitter;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    public $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}
