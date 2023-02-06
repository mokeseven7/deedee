<?php

namespace App\Tasks;

use App\Models\Renter;
use App\Tasks\RenterCanChange;

use Illuminate\Support\Facades\DB;
use App\Concerns\UseMultiRenterConfig;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ConfigurationException;



class SwtichRenterDatabaseTask implements RenterCanChange
{
    use UseMultiRenterConfig;

    public function makeCurrent(Renter $renter): void
    {
        $this->setRenterDatabaseConnection($renter->getDatabaseName());
    }

    public function forgetCurrent(): void
    {
        $this->setRenterDatabaseConnection(null);
    }

    protected function setRenterDatabaseConnection(?string $databaseName)
    {
        $renterConnectionName = $this->renterDatabaseConnectionName();

        if ($renterConnectionName === $this->ownerDatabaseConnectionName()) {
            throw ConfigurationException::tenantConnectionIsEmptyOrEqualsToLandlordConnection();
        }

        if (is_null(config("database.connections.{$renterConnectionName}"))) {
            throw ConfigurationException::tenantConnectionDoesNotExist($renterConnectionName);
        }

        config([
            "database.connections.{$renterConnectionName}.database" => $databaseName,
        ]);

        app('db')->extend($renterConnectionName, function ($config, $name) use ($databaseName) {
            $config['database'] = $databaseName;

            return app('db.factory')->make($config, $name);
        });

        DB::purge($renterConnectionName);


        Model::setConnectionResolver(app('db'));
    }
}
