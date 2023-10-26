<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class IncomeCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $income_categories = IncomeCategory::all();
        return view('admin.income.category.all', compact('income_categories'));
    }
    public function add(){
        return view('admin.income.category.add');
    }
    public function edit(){
        return view('admin.income.category.edit');
    }
    public function view($incate_slug){
        $data=IncomeCategory::where('incate_status',1)->where('incate_slug',$incate_slug)->firstOrFail();
        return view('admin.income.category.view', compact('data'));
    }
    public function insert(Request $request){

        // form validation here
        $validated = $request->validate([
            'name' => 'required|max:50|unique:income_categories,incate_name',
            'remarks' => 'required|max:150',
        ]);

        // slag here
        $slug = Str::slug($request['name']);
        // creator here
        $creator = Auth::user()->id;

        $insert = IncomeCategory::insert([
            'incate_name' => $request['name'],
            'incate_remarks' => $request['remarks'],
            'incate_creator' => $creator,
            'incate_slug' => $slug,
            'created_at' => Carbon::now()->toDateTimeLocalString(),
        ]);

        // make notification and redirect here

        if($insert){

            return redirect('dashboard/income/category')->with('success', 'Income Category Added Successfully');

        }else {
            return redirect('dashboard/income/add')->with('error', 'Opps, Something Is Wrong');
        }

    }
    public function update(){

    }
    public function softdelete(){

    }
    public function restore(){

    }
    public function delete(){

    }
}
