<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('configuration.users.index');
    }

    public function dt_users(Request $request)
    {
        $users = User::with('role')->get([
            'name', 'lastname', 'email', 'id', 'role_id'
        ]);

        return datatables()->of($users)->toJson();
    }

    public function create()
    {
        $roles = Role::pluck('role', 'id');

        return view('configuration.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'role_id' => 'required',
            'password' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            $user->save();

            DB::commit();

            return redirect()->route('users.index')->with('info', 'Usuario creado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
    }

    public function edit($id)
    {
        if ($id == null || $id == '') {
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
        $user = User::find($id);
        $roles = Role::pluck('role', 'id');

        return view('configuration.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'role_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            if ($request->password != '' || $request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->role_id = $request->role_id;
            $user->update();

            DB::commit();

            return redirect()->route('users.index')->with('info', 'Usuario actualizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->user_id);
            $user->delete();

            DB::commit();

            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json(false);
        }
    }
}
