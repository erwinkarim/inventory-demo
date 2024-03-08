<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with(['roles', 'permissions']) -> get();
        return response()->json(["users" => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Log::debug("update requested");
        $changes = $request -> only(["name", "roles", "permissions"]);

        /*
        Log::debug("name: ".$changes["name"]);
        Log::debug("roles: ".$changes["roles"]);
        Log::debug("permissions: ".implode(",", $changes["permissions"]));
        */

        // update user email
        $user -> update([
            "name" => $changes["name"],
        ]);

        $user = User::with(['roles', 'permissions']) -> find($user -> id);

        // reset and update permissions/roles
        // skip if user is admin. admin will always have admin roles.
        if($user -> email != 'admin@example.com'){
            if($changes["roles"] == 0){
                $permissions = Permission::find($changes["permissions"]);
                $user -> syncRoles([]);
                $user -> syncPermissions( $permissions );
            } else {
                $role = Role::find($changes["roles"]);
                $user -> syncRoles([ $role ]);
            }
        }


        return response()->json(["msg" => "ok", "user" => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        Log::debug("deleting user {$user -> id}");
        $user -> delete();

        return response()->json(["msg" => "ok"], 200);
    }

    // generate user from factory with user creds
    public function generate(){
       $user = User::factory() -> create(); 
       $role = Role::where('name', 'user') -> first();
       $user -> syncRoles([$role]);

       return response()->json($user, 200 );
    }
}
