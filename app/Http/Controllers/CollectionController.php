<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collecction;
use Illuminate\Support\Facades\Validator;
use DataTables;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $total = Collecction::sum('amount');
        return view('admin.collections', compact('total'));
    }

    public function getCollections()
    {
        $collections = Collecction::get();
        return DataTables::of($collections)
                ->addColumn('action', function($collections){
                    return '<div class="table-actions">
                                <a class="btn btn-sm btn-danger" href="'.url('collection/delete/'.$collections->id).'"  >Delete</a>
                            </div>';
                })
                ->editColumn('created_at', function($collections){
                    $date = new \DateTime($collections->created_at);
                    return $date->format('Y-m-d');
                })
                ->rawColumns(['action'])
                ->make(true);
    }


    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try{

            $collection = Collecction::create([
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'amount' => $request->amount
            ]);


            if($collection){ 
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
        $collection = Collecction::find($request->id);
        if(isset($request->name)){
            $collection->name = $request->name;
        }
        if(isset($request->contact_no)){
            $collection->contact_no = $request->contact_no;
        }
        if(isset($request->amount)){
            $collection->amount = $request->amount;
        }
        $collection->save();

        return $collection;
    }

 
    public function destroy($id)
    {
        Collecction::find($id)->delete();
        return redirect('/admin/collection')->with('success', 'Succesfully deleted!');
    }

}
