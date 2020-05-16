<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('configuration.roles.index');
    }

    public function dt_roles(Request $request)
    {
        $users = Role::get(['role', 'id']);

        return datatables()->of($users)->toJson();
    }
    public function create()
    {
        return view('configuration.roles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $role = new Role;
            $role->role = $request->role;
            $role->save();

            DB::commit();

            return redirect()->route('roles.index')->with('info', 'Rol creado con éxito');
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
        $role = Role::find($id);

        return view('configuration.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->role = $request->role;
            $role->update();

            DB::commit();

            return redirect()->route('roles.index')->with('info', 'Rol actualizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::find($request->role_id);
            $role->delete();

            DB::commit();

            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json(false);
        }
    }
}
