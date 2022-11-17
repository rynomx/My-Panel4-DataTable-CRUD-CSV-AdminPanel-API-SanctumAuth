<?php 

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRoleRequest;  
use App\Http\Requests\User\UpdateRoleRequest;  
use App\Models\Role; 
use App\Models\PermissionGroup; 
use App\Models\Permission; 
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller 
{ 
    public function index()
    { 
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('show-role', User::class);
        }

        $roles = Role::paginate(15);

        return view('users.roles.index', compact('roles'));
    }

    public function show($id)
    { 
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('show-role', User::class);
        }

        $role = Role::find($id);

        if(!$role){
            //$this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }  

        $permissions_ids = Permission::permissionsRole($role);

        $permission_groups = PermissionGroup::all();                       

        return view('users.roles.show',compact('role', 'permissions_ids', 'permission_groups'));
    }

    public function create()
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('create-role', User::class);
        }

        $permission_groups = PermissionGroup::all();

        return view('users.roles.create', compact('permission_groups'));
    }

    public function store(StoreRoleRequest $request)
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('create-role', User::class);
        }

        $role = Role::create($request->all());

        $permissions = $request->input('permissions') ? $request->input('permissions') : [];

        $role->permissions()->sync($permissions);

        //$this->flashMessage('check', 'Permission successfully added!', 'success');

        return redirect()->route('role.create');
    }

    public function edit($id)
    { 
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('edit-role', User::class);
        }

        $role = Role::find($id);

        if(!$role){
            $this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }  

        $permissions_ids = Permission::permissionsRole($role);

        $permission_groups = PermissionGroup::all();                       

        return view('users.roles.edit',compact('role', 'permission_groups', 'permissions_ids'));
    }

    public function update(UpdateRoleRequest $request,$id)
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('edit-role', User::class);
        }

        $role = Role::find($id);

        if(!$role){
            //$this->flashMessage('warning', 'Permission not found!', 'danger');            
            return redirect()->route('role');
        }

        $role->update($request->all());

        $permissions = $request->input('permissions') ? $request->input('permissions') : [];

        $role->permissions()->sync($permissions);

        //$this->flashMessage('check', 'Permission successfully updated!', 'success');

        return redirect()->route('role');
    }

    public function destroy($id)
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('destroy-role', User::class);
        }

        $role = Role::find($id);

        if(!$role){
            //$this->flashMessage('warning', 'Permissão não encontrada!', 'danger');            
            return redirect()->route('role');
        }

        $role->delete();

        //$this->flashMessage('check', 'Permission successfully deleted!', 'success');

        return redirect()->route('role');
    }
}