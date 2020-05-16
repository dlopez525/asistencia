<?php

namespace App\Http\Controllers;

use App\User;
use App\Schedule;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShedulesController extends Controller
{
    public function index()
    {
        $teachers = User::whereHas('role', function ($query) {
            $query->where('role', 'profesor');
        })->get();

        return view('schedules.index', compact('teachers'));
    }

    public function dt(Request $request)
    {
        $schedule = Schedule::with('user')
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

        return view('schedules.generate', compact('teachers'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $schedule = new Schedule;
            $schedule->user_id = $request->user_id;
            $schedule->l = $request->l;
            $schedule->m = $request->m;
            $schedule->mi = $request->mi;
            $schedule->j = $request->j;
            $schedule->v = $request->v;
            $schedule->time_from = $request->time_from;
            $schedule->time_to = $request->time_to; 
            $schedule->save();

            DB::commit();

            return redirect()->route('shedules.create')->with('info', 'Horario creado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        $teachers = User::whereHas('role', function ($query) {
            $query->where('role', 'profesor');
        })->pluck('name', 'id');

        return view('schedules.generate-edit', compact('teachers', 'schedule'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $schedule = Schedule::find($id);
            $schedule->user_id = $request->user_id;
            $schedule->l = $request->l;
            $schedule->m = $request->m;
            $schedule->mi = $request->mi;
            $schedule->j = $request->j;
            $schedule->v = $request->v;
            $schedule->time_from = $request->time_from;
            $schedule->time_to = $request->time_to; 
            $schedule->update();

            DB::commit();

            return redirect()->route('shedules.index')->with('info', 'Horario actualizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ooops! Ocurrió un error');
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $schedule = Schedule::find($request->schedule_id);
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
        $schedules = Schedule::with('user')
        ->where(function ($query) use($request) {
            if($request->get('teacher') != ''){
                $query->where('user_id', $request->get('teacher'));
            }
        })->get();

        $pdf = PDF::loadView('schedules.pdf', compact('schedules'));

        return $pdf->download('horario.pdf');
    }
}
