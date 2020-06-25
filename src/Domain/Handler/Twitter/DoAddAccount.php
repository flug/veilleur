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

namespace Veilleur\Domain\Handler\Twitter;

use Veilleur\Domain\Command\Twitter\Account\Add as AddAccount;

interface DoAddAccount
{
    public function __invoke(AddAccount $accountCommand);
}
