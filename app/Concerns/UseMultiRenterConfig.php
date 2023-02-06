<?php

namespace App\Concerns;

use App\Exceptions\ConfigurationException;

trait UseMultiRenterConfig {
    
    public function renterDatabaseConnectionName(): ?string
    {
        return config('multi.renter_database_connection_name') ?? config('database.default');
    }

    public function ownerDatabaseConnectionName(): ?string
    {
        return config('multi.owner_database_connection_name') ?? config('database.default');
    }

    public function currentRenterContainerKey(): string
    {
        return config('multi.current_renter_container_key');
    }

    public function getActionByName(string $actionName, string $actionClass)
    {
        $configuredClass = config("multitenancy.actions.{$actionName}") ?? $actionClass;

        if (! is_a($configuredClass, $actionClass, true)) {
            throw ConfigurationException::invalidAction(
                actionName: $actionName,
                configuredClass: $configuredClass ?? '',
                actionClass: $actionClass
            );
        }

        return app($configuredClass);
    }

    
}