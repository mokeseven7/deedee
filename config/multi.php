<?php

use App\Actions\RenterEvictedAction;

return [
    'renter_model' => App\Models\Renter::class,
    
    'current_renter_container_key' => 'currentRenter',
    
    'renter_locator' => \App\RenterLocator::class,

    'switch_renter_tasks' => [
        \Spatie\Multitenancy\Tasks\SwtichRenterDatabaseTask::class,
    ],

    'actions' => [
        'renter_rents' => \App\Actions\RenterRentingAction::class,
        'evict_renter' => \App\Actions\RenterEvictedAction::class,
    ],
];