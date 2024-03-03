<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::debug("getting inventory in api");

        $inventory = DB::table('inventories') -> paginate(21);
        $data = Inventory::limit(20) -> get();
        return response()->json(["data" => $data, "inventory" => $inventory], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        $validated = $request -> validated();
        $user = Auth::user();

        //
        $inventory = new Inventory([
            "user_id" => $user -> id,
            "name" => $request -> name,
            "desc" => $request -> desc,
            "picture" => $request -> picture,
        ]);
        $inventory -> save();

        return response()->json(["msg" => "ok", "inventory" => $inventory], 200 );
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $productId) {
        return response()->json($productId, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $productId)
    {
        //
        Log::debug("name: {$request -> name}");
        $productId -> update([
            "name" => $request -> name,
            "desc" => $request -> desc,
            "picture" => $request -> picture,
        ]);

        return response()->json(["msg" => "ok", "inventory" => $productId], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $productId)
    {
        //
        Inventory::destroy($productId -> id);
        return response()->json(["msg" => "ok"], 200);
    }

    // create 1000 units of inventory
    public function pump(){
        Inventory::factory() -> count(1000) -> create();

        return response()->json(["msg" => "ok"], 200);
    }
}
