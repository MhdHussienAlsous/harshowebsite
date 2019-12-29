<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Menu;
use App\Item;
use App\Language;
use App\Person;
use DB;
use Auth;
use Carbon\Carbon;
use App\Role;
use App\Permission;
use App\Template;
use Entrust;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }


    // this function to load dd user page
    public function addUser(){
        if (!Entrust::can('add-user')) {
            return redirect('/dashboard');
        }
        $permissions = DB::table('permissions')->where('show' , '1')->get();
        return view('user.add-user' , compact('permissions'));
    }

    // this function o store user into database
    public function storeUser(Request $request){
        if (!Entrust::can('add-user')) {
            return redirect('/dashboard');
        }

        $this->validate($request,
	        [
	            'name'    => 'required|min:4',
	            'email'   => 'required|unique:users',
	            'password'=> 'required|min:4',
	            'birthday'=> 'required',
	            'image'   => 'image|mimes:jpg,jpeg,png|max:2048',
	        ] ,
	        [
	            'name.required'    => 'Sorry!! the Name cannot be empty' ,
	            'name.min'         => 'Sorry!! the Name should be 4 character at less' ,
	            'email.required'   => 'Sorry!! the Email is required' ,
	            'email.unique'     => 'Sorry!! the Email is already exist' ,
	            'password.required'=> 'Sorry!! the Password is required' ,
	            'password.min'     => 'Sorry!! the Password should be 4 character at less' ,
	            'birthday.required'=> 'Sorry!! the Birthday cannot be empty' ,
	            'image.image'      => 'Sorry!! you should upload image' ,
	        ]
        );

        // store registration info user
        $user = new User;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
 
        // store information user
        $person = new Person;
        $person->name     = $request->name;
        $person->birthday = Carbon::parse($request->birthday)->format('Y/m/d');
        $person->user_id  = $user->id;

        if (isset($request->image) && !empty($request->image)) {
            $image_name  = rand().time().rand().'.'.$request->image->getClientOriginalExtension();
            $person->image = 'upload/people/'.$image_name;
            Image::make($request->image)->save($person->image);   
        } else {
            $person->image = 'upload/people/default-avatar.png';
         
        }

        $person->save();

        // create role of this user
            $role = new Role();
            $role->name  = 'user'.$user->id;
            $role->save();
            $user->attachRole($role);
            

        if ($request->role == 0) {
            // if role == admin ==> get all permissions from databse
            $permissions = Permission::all();
            
            // then linked all permissions with role
            $role->attachPermissions($permissions);

        } else {
            // if role == moderator ==> store all permission from user into this role
            $role->attachPermissions($request->permissions);
        }

       return back()->with('message', 'User added successfully !!');
    }

    public function allUsers(){
         $users = User::with('person')->get();
         return view('user.all-users', compact('users'));
    }

    public function deleteUser(User $user){
        if (!Entrust::can('delete-user')) {
            return redirect('/dashboard');
        }

        // get role of user
        $role = Role::where('name' , 'user'.$user->id)->first();

        // delete all permissions of role
        $role->perms()->sync([]); 

        // delete all relationship user and role
        $user->roles()->detach();

        // delete role
        $role = DB::table('roles')->where('name' , 'user'.$user->id)->delete();

        // delete user
        $user->delete();

        // redirect ..
        return back()->with('message', 'User deleted successfully !!');
    }

    // this function to load edit user page
    public function editUser(User $user){
        if (!Entrust::can('update-user')) {
            return redirect('/dashboard');
        }

        $admin_selected     = '';
        $moderator_selected = '';
        $user_permissions   = array();

        // get all permissions form database
        $permissions = DB::table('permissions')->where('show' , '1')->get();



        foreach ($user->roles as $role) {
            if (count($permissions) == count($role->perms)) {
              $admin_selected = 'selected';
            }  else {
              $moderator_selected = 'selected'; 
            }
 
            foreach ($role->perms as $perm) {
                $user_permissions[] = $perm->id;
            }
        }
        return view('user.edit-user' , compact('user' , 'permissions' , 'admin_selected' , 'moderator_selected' , 'user_permissions' ));
    }


    // this function to update data user 
    public function updateUser(Request $request , User $user){
        if (!Entrust::can('update-user')) {
            return redirect('/dashboard');
        }

        $this->validate($request,[
	            'name'    => 'required|min:4',
	            'email'   => 'required',
	            'birthday'=> 'required',
	            'image'   => 'image|mimes:jpg,jpeg,png|max:2048',
	        ] ,
	        [
	            'name.required'    => 'Sorry!! the Name cannot be empty' ,
	            'name.min'         => 'Sorry!! the Name should be 4 character at less' ,
	            'email.required'   => 'Sorry!! the Email is required' ,
	            'birthday.required'=> 'Sorry!! the Birthday cannot be empty' ,
	            'image.image'      => 'Sorry!! you should upload image' ,
	        ]
        );

        $user->email    = $request->email;

        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // get info of user
        $person = Person::where('user_id' , $user->id)->first();

        $person->name     = $request->name;

        $person->birthday = Carbon::parse($request->birthday)->format('Y/m/d');

        if (isset($request->image) && !empty($request->image)) {
            $image_name  = rand().time().rand().'.'.$request->image->getClientOriginalExtension();
            $person->image = 'upload/people/'.$image_name;
            Image::make($request->image)->save($person->image);   
        }

        $person->save();


        // get role of user
        $role = Role::where('name' , 'user'.$user->id)->first();

        if ($request->role == 0) {

            // if role == admin ==> get all permissions from databse
            $permissions = Permission::all();
            
            // then linked all permissions with role
            $role->perms()->sync($permissions);

        } else {
            // if role == moderator ==> store all permission from user into this role
            $role->perms()->sync($request->permissions);
        }

        return back()->with('message', 'User updated info successfully !!');
    }
}
