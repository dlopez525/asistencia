<?php

namespace App\Http\Controllers;

use App\User;
use App\ScheduleRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class AsistenceController extends Controller
{
    public function index()
    {
        $teachers = User::whereHas('role', function ($query) {
            $query->where('role', 'profesor');
        })->get();

        return view('asistence.index', compact('teachers'));
    }

    public function dt(Request $request)
    {
        $schedule = ScheduleRegister::with('user')
        ->where(function ($query) use($request) {
            if($request->get('teacher') != ''){
                $query->where('user_id', $request->get('teacher'));
            }
        })->get();

        return datatables()->of($schedule)->toJson();
    }

    public function create()
    {
        $teachers = User::whereHas('role', function ($query) {
            $query->where('role', 'profesor');
        })->pluck('name', 'id');

        return view('asistence.generate', compact('teachers'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $schedule = new ScheduleRegister;
            $schedule->user_id = $request->user_id;
            $schedule->date = date('Y-m-d', strtotime($request->date));
            $schedule->entry = $request->entry;
            $schedule->exit = $request->exit; 
            $schedule->save();

            DB::commit();

            return redirect()->route('asistence.index')->with('info', 'Asistencia creado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
    }

    public function edit($id)
    {
        $schedule = ScheduleRegister::find($id);
        $teachers = User::whereHas('role', function ($query) {
            $query->where('role', 'profesor');
        })->pluck('name', 'id');

        return view('asistence.generate-edit', compact('teachers', 'schedule'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $schedule = ScheduleRegister::find($id);
            $schedule->user_id = $request->user_id;
            $schedule->date = date('Y-m-d', strtotime($request->date));
            $schedule->entry = $request->entry;
            $schedule->exit = $request->exit; 
            $schedule->update();

            DB::commit();

            return redirect()->route('asistence.index')->with('info', 'Asistencia actualizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $schedule = ScheduleRegister::find($request->asistence_id);
            $schedule->delete();

            DB::commit();

            return response()->json(true);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json(false);
        }
    }

    public static function exportPDF(Request $request)
    {
        $schedules = ScheduleRegister::with('user')
        ->where(function ($query) use($request) {
            if($request->get('teacher') != ''){
                $query->where('user_id', $request->get('teacher'));
            }
        })->get();

        $pdf = PDF::loadView('asistence.pdf', compact('schedules'));

        return $pdf->download('asistencia.pdf');
    }
}
