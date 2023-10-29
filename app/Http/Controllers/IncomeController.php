<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Income;
use Carbon\Carbon;
use Session;
use Auth;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $all = Income::where('income_status', 1)->orderBy('income_date', 'DESC')->get();
        return view('admin.income.main.all', compact('all'));
    }

    public function add()
    {
        return view('admin.income.main.add');
    }

    public function edit($slug)
    {
        $data = Income::where('income_status', 1)->where('income_slug', $slug)->firstOrFail();
        return view('admin.income.main.edit', compact('data'));
    }

    public function view($slug)
    {
        $data = Income::where('income_status', 1)->where('income_slug', $slug)->firstOrFail();
        return view('admin.income.main.view', compact('data'));
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'category' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        $slug = 'I' . uniqid(20);
        $creator = Auth::user()->id;

        $insert = Income::insert([
            'income_title' => $request['title'],
            'incate_id' => $request['category'],
            'income_date' => $request['date'],
            'income_amount' => $request['amount'],
            'income_creator' => $creator,
            'income_slug' => $slug,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($insert) {
            return redirect('dashboard/income')->with('success', 'Income Insert Successfully');
        } else {
            return redirect('dashboard/income/add')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'category' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        $id = $request['id'];
        $slug = $request['slug'];
        $editor = Auth::user()->id;

        $update = Income::where('income_status', 1)->where('income_id', $id)->update([
            'income_title' => $request['title'],
            'incate_id' => $request['category'],
            'income_date' => $request['date'],
            'income_amount' => $request['amount'],
            'income_editor' => $editor,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($update) {
            return redirect('dashboard/income')->with('success', 'Income Update Successfully');
        } else {
            return redirect('dashboard/income/edit')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function softdelete()
    {
        $id = $_POST['modal_id'];
        $soft = Income::where('income_status', 1)->where('income_id', $id)->update([
            'income_status' => 0,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($soft) {
            return redirect('dashboard/income')->with('success', 'Income Move To Trash Successfully');
        } else {
            return redirect('dashboard/income')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function restore()
    {
        $id = $_POST['modal_id'];
        $restore = Income::where('income_status', 0)->where('income_id', $id)->update([
            'income_status' => 1,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($restore) {
            return redirect('dashboard/income/recycle')->with('success', 'Income Restore Successfully');
        } else {
            return redirect('dashboard/income/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function delete()
    {
        $id = $_POST['modal_id'];
        $delete = Income::where('income_status', 0)->where('income_id', $id)->delete([]);

        if ($delete) {
            return redirect('dashboard/income/recycle')->with('success', 'Income Permanently Successfully');
        } else {
            return redirect('dashboard/income/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }
}
