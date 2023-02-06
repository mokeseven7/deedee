<?php

namespace App;

use App\Models\Renter;
use Illuminate\Http\Request;
use App\Concerns\UsesRenterModel;

class RenterLocator {

    use UsesRenterModel;

    public function findForRequest(Request $request): ?Renter {
        
        $host = $request->getHost();

        return $this->getRenterModel()->where('domain', $host)->first();
    }
}