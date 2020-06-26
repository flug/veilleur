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

namespace Veilleur\Domain\Handler\Github;

use Veilleur\Domain\Command\Github\Topic\Delete;

interface DoRemoveTopic
{
    public function __invoke(Delete $delete);
}
