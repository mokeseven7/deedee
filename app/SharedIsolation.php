<?php

namespace App;

use App\Models\Renter;
use App\RenterLocator;
use App\Tasks\TasksCollection;
use App\Concerns\UsesRenterModel;
use App\Concerns\UseMultiRenterConfig;
use Illuminate\Contracts\Foundation\Application;

class SharedIsolation {

    use UsesRenterModel, UseMultiRenterConfig;

    public function __construct(public Application $app){}


    public function start(): void {
        $this->registerRenterLocator()
            ->registerContextChangeTasks()
            ->configureRequests();

    }

    public function end(): void {
        Renter::forgetCurrent();
    }

    protected function registerRenterLocator(): self
    {
        if ($this->app['config']->get('multi.renter_locator')) {
            
            $this->app->bind(RenterLocator::class, $this->app['config']->get('multi.renter_locator'));
        }
        
        return $this;
    }

    protected function registerContextChangeTasks(): self
    {
        $this->app->singleton(TasksCollection::class, function () {
            $taskClassNames = $this->app['config']->get('multitenancy.switch_renter_tasks');

            return new TasksCollection($taskClassNames);
        });

        return $this;
    }

    protected function locateCurrentRenter(): void
    {
        if (! $this->app['config']->get('multi.renter_locator')) {
            return;
        }

        
        $renterLocator = $this->app[RenterLocator::class];

        $renter = $renterLocator->findForRequest($this->app['request']);

        $renter?->makeCurrent();
    }

    protected function configureRequests(): self
    {
        if (! $this->app->runningInConsole()) {
            $this->locateCurrentRenter();
        }

        return $this;
    }

}