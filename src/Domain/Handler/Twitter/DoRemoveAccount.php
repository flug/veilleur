<?php
declare(strict_types=1);

namespace Veilleur\Domain\Handler\Twitter;

use Veilleur\Domain\Command\Twitter\Account\Delete;

interface DoRemoveAccount
{
    
    public function __invoke(Delete $delete);
}
