<?php

namespace App\Http\Controllers;


use App\Models\DeeDee;
use App\Http\Requests\DeleteDeeDeeRequest;
use App\Http\Requests\StoreDeeDeeRequest;
use App\Http\Requests\UpdateDeeDeeRequest;

// Paying Homage to DHH and Ruby. The most beloved fn of all 

class DeeDeeController extends Controller
{
    public function index(){
        return response()->json(DeeDee::paginate(15));
    }

    public function show(DeeDee $deedee){
        return response()->json($deedee);
    }

    public function store(StoreDeeDeeRequest $request){
        return tap(DeeDee::create($request->safe()->all()), fn($deedee) => response()->json($deedee));
    }

    public function update(UpdateDeeDeeRequest $request, DeeDee $deedee){
        return tap($request->safe()->all(), fn ($valid) => response()->json($deedee->update($valid)));
    }

    public function destroy(DeeDee $deedee, DeleteDeeDeeRequest $request){
        return tap($request->safe()->all(), fn() => response()->json($deedee->delete(), ));
    }
}
