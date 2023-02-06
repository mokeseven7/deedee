<?php

namespace App\Models;

use App\Actions\RenterEvictedAction;
use App\Actions\RenterRentingAction;
use App\Concerns\UsesOwnerConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Renter extends Model
{
    use HasFactory, UsesOwnerConnection;

    public function makeCurrent(): static
    {
        if ($this->isCurrent()) {
            return $this;
        }

        static::forgetCurrent();

        $this->getActionByName(actionName: 'renter_rents', actionClass: RenterRentingAction::class)->execute($this);

        return $this;
    }

    public function forget(): static
    {
        $this->getMultitenancyActionClass(
                actionName: 'evict_renter',
                actionClass: RenterEvictedAction::class
            )
            ->execute($this);

        return $this;
    }

    public static function current(): ?static
    {
        $containerKey = config('multi.current_renter_container_key');
       
        
        if (!app()->has($containerKey)) {
            return null;
        }

        return app($containerKey);
    }

    public static function checkCurrent(): bool {
        return static::current() !== null;
    }

    public function isCurrent(): bool
    {
        return static::current()?->getKey() === $this->getKey();
    }
   

    public static function forgetCurrent(): ?Renter
    {
        $currentRenter = static::current();

        if (is_null($currentRenter)) {
            return null;
        }

        $currentRenter->forget();

        return $currentRenter;
    }

    public function getDatabaseName(): string
    {
        return $this->database;
    }

    
    
}
