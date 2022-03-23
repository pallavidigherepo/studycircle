<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RoleRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = RoleResource::collection(Role::latest()->orderBy('id', 'DESC')->simplePaginate(10));
        //dd($roles);
        /*$roles = Role::when(request('search'), function ($query) {
                                                    $query->where('name', 'like', '%'. request('search'). '%');
                                                })->orderBy('id', 'desc')->get();*/
        return response()->json($roles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'permissions' => $request->permissions,
                'guard_name' => 'web',
            ];
            $role = Role::create($inputs);
            $role->syncPermissions($inputs['permissions']);
            $response = [
                'success' => true,
                'message' => 'Permission created successfully.',
                'role' => $role,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // We have to format role and permissions according to discussion.
        // First of all get all the list of permissions
        
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $permissionId = $permission->id;
            $explodedPermission = array_reverse(explode(' ', $permission->name));

            $moduleName = $explodedPermission[0];

            if (count($explodedPermission) > 2) {
                $j = 0;
                for ($i = 1; $i < count($explodedPermission); $i++ ) {
                    $remaining[$j++] = $explodedPermission[$i];
                }
                $actionName = implode(' ', array_reverse($remaining));
            } else {
                $actionName = $explodedPermission[1];
            }
            $key = 'All';
            if (isset($remaining) && count($remaining) > 0) {
                $key = 'Own';
            }
            $final[$moduleName][$key][$permissionId] = $actionName;
        }
        $response = $role;
        $oldPermissions = [];
        $rolePermissions = $role->permissions;
        $i = 0;
        foreach ($rolePermissions as $permission) {
            $oldPermissions[$i++] = $permission->id;
        }
        $response->id = $role->id;
        $response->name = $role->name;
        $response->oldpermissions = $oldPermissions;
        

        return response()->json(['response' => $response, 'final' => $final], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'permissions' => $request->permissions,
            ];
            $role->name = $request->name;
            $role->save($inputs);
            $role->syncPermissions($inputs['permissions']);

            $response = [
                'success' => true,
                'message' => 'Role updated successfully.',
                'role' => $role,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($role->delete()) {
            $response = [
                'success' => true,
                'message' => 'Role deleted successfully.',
                'role' => $role,
                'roles' => RoleResource::collection(Role::latest()->simplePaginate(10)),
            ];
        }
        return response()->json($response);
    }
}
