<?php

namespace App\Http\Controllers;

use App\Course;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Carbon::setLocale('es');
        setlocale(LC_TIME,"es_ES");
        $days = $this->getDays('tuesday');

        $d = array();

        foreach ($days as $day)
        {
            $d[] = $day->format('l d-m-Y');
        }

        // dd($d);

        return view('home');
    }

    public function getDays(string $day)
    {
        Carbon::setLocale('es');
        setlocale(LC_TIME,"es_ES");
        return new \DatePeriod(
            Carbon::parse("first ". $day ." of this month"),
            CarbonInterval::week(),
            Carbon::parse("first ". $day ." of next month")
        );
    }
}
