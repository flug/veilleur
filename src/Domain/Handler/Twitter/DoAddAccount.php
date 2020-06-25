<?php
declare(strict_types=1);

namespace Veilleur\Domain\Handler\Twitter;

use Veilleur\Domain\Command\Twitter\Account\Add as AddAccount;

interface DoAddAccount
{
    public function __invoke(AddAccount $accountCommand);
}
