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
    public function index(Request $request)
    {
        Log::debug("getting inventory in api");
        Log::debug("request -> category: {$request -> category}");

        $inventory = DB::table('inventories');
        $inventory = $inventory 
            -> join('categories', 'inventories.category_id', '=', 'categories.id') 
            -> select('inventories.id as id', 'inventories.name as name', 'desc', 'picture', 'category_id', 'categories.name as cat_name');

        if($request -> category != null){
            Log::debug("got category");
            $inventory = $inventory -> whereIn('category_id', explode(",", $request -> category) ); 
            $search["category"] = $request -> category;
        } else {
            Log::debug("no category");
            // $inventory = DB::table('inventories'); 
            $search["category"] = "";
        }


        $search["q"] = "";
        if($request -> q != null){
            $inventory = $inventory -> where('inventories.name', 'like', "%{$request -> q}%");
            $search["q"] = $request -> q;
        }

        $inventory = $inventory -> paginate(21);

        return response()->json(["inventory" => $inventory, "search" => $search], 200);
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
