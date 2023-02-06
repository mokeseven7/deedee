<?php

namespace App\Concerns;

use App\Concerns\UseMultiRenterConfig;

trait UsesOwnerConnection
{
    use UseMultiRenterConfig;

    public function getConnectionName()
    {
        return $this->ownerDatabaseConnectionName();
    }
}
