<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collecction;
use App\Models\Expense;
use stdClass,DB;

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
        $collections = Collecction::select(
                            DB::raw('sum(amount) as amount'),
                            DB::raw('CAST(created_at AS DATE) as date')
                        )
                        ->groupBy(DB::raw('CAST(created_at AS DATE)'))
                        ->orderBy('id','DESC')
                        ->take(6)
                        ->get()
                        ->toArray();

        $expenses = Expense::select(
                        DB::raw('sum(amount) as expense'),
                        'exp_date'
                    )
                    ->groupBy('exp_date')
                    ->orderBy('id','DESC')
                    ->take(6)
                    ->get()
                    ->toArray();

        $data = new stdClass();
        $data->donor      = Collecction::count();
        $data->collection = Collecction::sum('amount');
        $data->expense    = Expense::sum('amount');




        return view('admin.dashboard', compact('data','collections','expenses'));
    }
}
