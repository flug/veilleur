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

namespace Veilleur\Domain\Model\Github;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Topic
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }
}
