<?php

namespace App\Tasks;

use App\Models\Renter;


interface RenterCanChange
{
    public function makeCurrent(Renter $renter): void;

    public function forgetCurrent(): void;
}
