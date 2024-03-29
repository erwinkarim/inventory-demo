<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use App\Models\InventoryCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Log::debug('should show inventory index');
        $categories = InventoryCategory::all();
        $search = array_merge(["q" => "", "category" => [""]], $request -> only(["category", "q"]));
        if($search["category"] != [""]){
            $search["category"] = explode(",", $search["category"]);
        }
        
        return view('inventory.index', ["categories" => $categories, "search" => $search] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $inventory = new Inventory();
        $inventory -> picture = "https://picsum.photos/200/300";

        return view('inventory.create', ["inventory" => $inventory]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $productId) {
        Log::debug('should show inventory show');
        Log::debug('request');
        Log::debug($productId);

        // check if exits, otherwise just return 404
        if($productId == null){
            abort(404);
        }

        $inventory = Inventory::with('category') -> find($productId -> id);

        return view('inventory.show', ["inventory" => $inventory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $productId)
    {
        //
        return view('inventory.edit', ["inventory" => $productId]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
