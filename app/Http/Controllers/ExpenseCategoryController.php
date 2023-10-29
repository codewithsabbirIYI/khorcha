<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExpenseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expense_categories = ExpenseCategory::Where('expcate_status', 1)->orderBy('expcate_id', 'DESC')->get();
        return view('admin.expense.category.all', compact('expense_categories'));
    }
    public function add()
    {
        return view('admin.expense.category.add');
    }
    public function edit($slug)
    {
        $data = ExpenseCategory::where('expcate_status', 1)->where('expcate_slug', $slug)->firstOrFail();
        return view('admin.expense.category.edit', compact('data'));
    }
    public function view($expcate_slug)
    {
        $data = ExpenseCategory::where('expcate_status', 1)->where('expcate_slug', $expcate_slug)->firstOrFail();
        return view('admin.expense.category.view', compact('data'));
    }
    public function insert(Request $request)
    {

        // form validation here
        $validated = $request->validate([
            'name' => 'required|max:50|unique:expense_categories,expcate_name',
            'remarks' => 'required|max:150',
        ]);

        // slag here
        $slug = Str::slug($request['name']);
        // creator here
        $creator = Auth::user()->id;

        $insert = ExpenseCategory::insert([
            'expcate_name' => $request['name'],
            'expcate_remarks' => $request['remarks'],
            'expcate_creator' => $creator,
            'expcate_slug' => $slug,
            'created_at' => Carbon::now()->toDateTimeLocalString(),
        ]);

        // make notification and redirect here

        if ($insert) {

            return redirect('dashboard/expense/category')->with('success', 'expense Category Added Successfully');
        } else {
            return redirect('dashboard/expense/add')->with('error', 'Opps, Something Is Wrong');
        }
    }
    public function update(Request $request)
    {

        //id here
        $id = $request['id'];

        // form validation here
        $validated = $request->validate([
            'name' => 'required|max:50|unique:expense_categories,expcate_name,' . $id . ',expcate_id',
            'remarks' => 'required|max:150',
        ]);

        // slag here
        $slug = Str::slug($request['name']);
        // editor here
        $editor = Auth::user()->id;

        $update = ExpenseCategory::where('expcate_status', 1)->where('expcate_id', $id)->update([
            'expcate_name' => $request['name'],
            'expcate_remarks' => $request['remarks'],
            'expcate_editor' => $editor,
            'expcate_slug' => $slug,
            'updated_at' => Carbon::now()->toDateTimeLocalString(),
        ]);

        // make notification and redirect here

        if ($update) {

            return redirect('dashboard/expense/category/view/' . $slug)->with('success', 'expense Category Updated Successfully');
        } else {
            return redirect('dashboard/expense/category/view/' . $slug)->with('error', 'Opps, Something Is Wrong');
        }
    }
    public function softdelete()
    {
        $id = $_POST['modal_id'];
        $soft = ExpenseCategory::where('expcate_status', 1)->where('expcate_id', $id)->update([
            'expcate_status' => 0,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($soft) {

            return redirect('dashboard/expense/category')->with('success', 'expense Category Move To Trash Successfully');
        } else {
            return redirect('dashboard/expense/category')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function restore()
    {
        $id = $_POST['modal_id'];
        $restore = ExpenseCategory::where('expcate_status', 0)->where('expcate_id', $id)->update([
            'expcate_status' => 1,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($restore) {

            return redirect('dashboard/expense/category/recycle')->with('success', 'expense Category Restore Successfully');
        } else {
            return redirect('dashboard/expense/category/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function delete()
    {
        $id = $_POST['modal_id'];
        $delete = ExpenseCategory::where('expcate_status', 0)->where('expcate_id', $id)->delete([]);

        if ($delete) {

            return redirect('dashboard/expense/category/recycle')->with('success', 'expense Category Permanently Deleted Successfully');
        } else {
            return redirect('dashboard/expense/category/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }
}
