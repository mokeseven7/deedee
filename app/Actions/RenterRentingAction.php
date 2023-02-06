<?php

namespace App\Actions;

use App\Models\Renter;
use App\Tasks\RenterCanChange;
use App\Tasks\TasksCollection;
use Spatie\Multitenancy\Models\Tenant;



class RenterRentingAction
{
    public function __construct(protected TasksCollection $tasksCollection) {}

    public function execute(Renter $renter)
    {

        $this->unbindRenterContext($renter)->bindNew($renter);

        return $this;
    }

    protected function unbindRenterContext(Renter $renter): self
    {
        $this->tasksCollection->each(fn (RenterCanChange $task) => $task->makeCurrent($renter));

        return $this;
    }

    protected function bindNew(Renter $renter): self
    {
        $containerKey = config('multi.current_renter_container_key');

        app()->forgetInstance($containerKey);

        app()->instance($containerKey, $renter);

        return $this;
    }
}
