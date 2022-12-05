<?php 

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;  
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdatePasswordUserRequest;
use App\Models\User; 
use App\Models\Role; 
use Illuminate\Support\Facades\Auth;

class UserController extends Controller 
{ 
    public function index()
    { 
        if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('show-user', User::class);
        }

        $users = User::paginate(15);

        return view('users.index', compact('users'));
    }

    public function show($id)
    { 
    	if (Auth::user()->designation !== 'dev' && Auth::user()->designation !== 'adm'){
            $this->authorize('show-user', User::class);
        }

    	$user = User::find($id);

    	if(!$user){
        	//$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);      	               

        return view('users.show',compact('user', 'roles', 'roles_ids'));
    }

    public function create()
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('create-user', User::class);
        }

        $roles = Role::all();

        return view('users.create',compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('create-user', User::class);
        }

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user = User::create($request->all());

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->roles()->sync($roles);

        //$this->flashMessage('check', 'User successfully added!', 'success');

        // return redirect()->route('user.create');
        return redirect()->route('user');
    }
 
    public function edit($id)
    { 
    	if (Auth::user()->designation !== 'dev'){
            $this->authorize('edit-user', User::class);
        }

    	$user = User::find($id);

    	if(!$user){
        	//$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }  

        $roles = Role::all();

		$roles_ids = Role::rolesUser($user);       	               

        return view('users.edit',compact('user', 'roles', 'roles_ids'));
    }

    public function update(UpdateUserRequest $request,$id)
    {
    	if (Auth::user()->designation !== 'dev'){
            $this->authorize('edit-user', User::class);
        }

    	$user = User::find($id);

        if(!$user){
        	//$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $user->update($request->all());

        $roles = $request->input('roles') ? $request->input('roles') : [];

        $user->roles()->sync($roles);

        //$this->flashMessage('check', 'User updated successfully!', 'success');

        return redirect()->route('user');
    }

    public function updatePassword(UpdatePasswordUserRequest $request,$id)
    {
    	if (Auth::user()->designation !== 'dev'){
            $this->authorize('edit-user', User::class);
        }

    	$user = User::find($id);

        if(!$user){
        	//$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user->update($request->all());

        //$this->flashMessage('check', 'User password updated successfully!', 'success');

        return redirect()->route('user');
    }

    public function editPassword($id)
    { 
    	if (Auth::user()->designation !== 'dev'){
            $this->authorize('edit-user', User::class);
        }

    	$user = User::find($id);

    	if(!$user){
        	//$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }              	               

        return view('users.edit_password',compact('user'));
    }

    public function destroy($id)
    {
        if (Auth::user()->designation !== 'dev'){
            $this->authorize('destroy-user', User::class);
        }

        $user = User::find($id);

        if(!$user){
            //$this->flashMessage('warning', 'User not found!', 'danger');            
            return redirect()->route('user');
        }

        $user->delete();

        //$this->flashMessage('check', 'User successfully deleted!', 'success');

        return redirect()->route('user');
    }
}