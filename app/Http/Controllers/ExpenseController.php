<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Validator;
use DataTables;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $total = Expense::sum('amount');
        return view('admin.expenses', compact('total'));
    }

    public function getExpenses()
    {
        $expenses = Expense::get();
        return DataTables::of($expenses)
                ->addColumn('action', function($expenses){
                    return '<div class="table-actions">
                                <a class="btn btn-sm btn-danger" href="'.url('expense/delete/'.$expenses->id).'"  >Delete</a>
                            </div>';
                })
                ->editColumn('exp_date', function($expenses){
                    $date = new \DateTime($expenses->exp_date);
                    return $date->format('Y-m-d');
                })
                ->rawColumns(['action'])
                ->make(true);
    }


    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exp_date' => 'required',
            'amount' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{

            $expense = Expense::create([
                'exp_date' => $request->exp_date,
                'reason' => $request->reason,
                'amount' => $request->amount
            ]);


            if($expense){ 
                return redirect()->back()->with('success', 'Amount saved succesfully!');
            }else{
                return redirect()->back()->with('error', 'Failed to save! Try again.');
            }

        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    public function update(Request $request)
    {
        // update permission table
        $expense = Expense::find($request->id);
        if(isset($request->exp_date)){
            $expense->exp_date = $request->exp_date;
        }
        if(isset($request->reason)){
            $expense->reason = $request->reason;
        }
        if(isset($request->amount)){
            $expense->amount = $request->amount;
        }
        $expense->save();

        return $expense;
    }

 
    public function destroy($id)
    {
        Expense::find($id)->delete();
        return redirect('/admin/collection')->with('success', 'Succesfully deleted!');
    }

}
