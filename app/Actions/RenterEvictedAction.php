<?php

namespace App\Actions;


use App\Models\Renter;
use App\Tasks\RenterCanChange;
use App\Tasks\TasksCollection;

class RenterEvictedAction
{
    public function __construct(protected TasksCollection $tasksCollection) {}

    public function execute(Renter $Renter)
    {
        $this->evictTennant()->andUnbind();
    }

    protected function evictTennant(): self
    {
        $this->tasksCollection->each(fn (RenterCanChange $task) => $task->forgetCurrent());

        return $this;
    }

    protected function andUnbind()
    {
        $containerKey = config('multi.current_renter_container_key');

        app()->forgetInstance($containerKey);
    }
}
