<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(){
        return view('user.add',['roles' => Role::all()]);
    }

    public function index()
    {
        $users = User::with('role')->get();
        return view('user.list',['users' => $users]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'role' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->role_id = $request->input('role');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if($user->role()->associate(Role::findOrFail($user->role_id))->save()){
            return redirect()->back()->with('message', 'Usuario guardado correctamente !!');
        }

    }

    public function show($id)
    {
        return view ('user.edit', ['user' => User::with('role')->findOrFail($id),'roles' => Role::all()]);
    }

    public function update(Request $request)
    {
        //return $request;

        $request->validate([
            'name' => 'required|max:100',
            'role' => 'required',
            'email' => 'required|unique:users,email,'.$request->input('id')
            //'password' => 'required'
        ]);

        $user = User::with('role')->findOrFail($request->input('id'));
        $user->name = $request->input('name');
        $user->role_id = $request->input('role');
        $user->email = $request->input('email');
        if(empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }
        $user->role()->associate(Role::findOrFail($user->role_id));

        if($user->save()){
            return redirect()->back()->with('message', 'Usuario actualizado correctamente !!');
        }    
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->delete()){
            return redirect()->back()->with('messageDelete', 'Usuario ha sido Eliminado !!');
        }

    }

}
