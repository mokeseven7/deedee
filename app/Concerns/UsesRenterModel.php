<?php

namespace App\Concerns;

use App\Models\Renter;

trait UsesRenterModel
{
    public function getRenterModel(): Renter
    {
        $renterModel = config('multi.renter_model');

        return new $renterModel;
    }
}
