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

    public function index()
    {
        $income_categories = IncomeCategory::Where('incate_status', 1)->orderBy('incate_id', 'DESC')->get();
        return view('admin.income.category.all', compact('income_categories'));
    }
    public function add()
    {
        return view('admin.income.category.add');
    }
    public function edit($slug)
    {
        $data = IncomeCategory::where('incate_status', 1)->where('incate_slug', $slug)->firstOrFail();
        return view('admin.income.category.edit', compact('data'));
    }
    public function view($incate_slug)
    {
        $data = IncomeCategory::where('incate_status', 1)->where('incate_slug', $incate_slug)->firstOrFail();
        return view('admin.income.category.view', compact('data'));
    }
    public function insert(Request $request)
    {

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

        if ($insert) {

            return redirect('dashboard/income/category')->with('success', 'Income Category Added Successfully');
        } else {
            return redirect('dashboard/income/add')->with('error', 'Opps, Something Is Wrong');
        }
    }
    public function update(Request $request)
    {

        //id here
        $id = $request['id'];

        // form validation here
        $validated = $request->validate([
            'name' => 'required|max:50|unique:income_categories,incate_name,' . $id . ',incate_id',
            'remarks' => 'required|max:150',
        ]);

        // slag here
        $slug = Str::slug($request['name']);
        // editor here
        $editor = Auth::user()->id;

        $update = IncomeCategory::where('incate_status', 1)->where('incate_id', $id)->update([
            'incate_name' => $request['name'],
            'incate_remarks' => $request['remarks'],
            'incate_editor' => $editor,
            'incate_slug' => $slug,
            'updated_at' => Carbon::now()->toDateTimeLocalString(),
        ]);

        // make notification and redirect here

        if ($update) {

            return redirect('dashboard/income/category/view/' . $slug)->with('success', 'Income Category Updated Successfully');
        } else {
            return redirect('dashboard/income/category/view/' . $slug)->with('error', 'Opps, Something Is Wrong');
        }
    }
    public function softdelete()
    {
        $id = $_POST['modal_id'];
        $soft = IncomeCategory::where('incate_status', 1)->where('incate_id', $id)->update([
            'incate_status' => 0,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($soft) {

            return redirect('dashboard/income/category')->with('success', 'Income Category Move To Trash Successfully');
        } else {
            return redirect('dashboard/income/category')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function restore()
    {
        $id = $_POST['modal_id'];
        $restore = IncomeCategory::where('incate_status', 0)->where('incate_id', $id)->update([
            'incate_status' => 1,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($restore) {

            return redirect('dashboard/income/category/recycle')->with('success', 'Income Category Restore Successfully');
        } else {
            return redirect('dashboard/income/category/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function delete()
    {
        $id = $_POST['modal_id'];
        $delete = IncomeCategory::where('incate_status', 0)->where('incate_id', $id)->delete([]);

        if ($delete) {

            return redirect('dashboard/income/category/recycle')->with('success', 'Income Category Permanently Deleted Successfully');
        } else {
            return redirect('dashboard/income/category/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }
}
