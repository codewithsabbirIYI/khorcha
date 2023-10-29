<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\expense;
use Carbon\Carbon;
use Session;


class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $all = Expense::where('expense_status', 1)->orderBy('expense_date', 'DESC')->get();
        return view('admin.expense.main.all', compact('all'));
    }

    public function add()
    {
        return view('admin.expense.main.add');
    }

    public function edit($slug)
    {
        $data = Expense::where('expense_status', 1)->where('expense_slug', $slug)->firstOrFail();
        return view('admin.expense.main.edit', compact('data'));
    }

    public function view($slug)
    {
        $data = Expense::where('expense_status', 1)->where('expense_slug', $slug)->firstOrFail();
        return view('admin.expense.main.view', compact('data'));
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

        $insert = Expense::insert([
            'expense_title' => $request['title'],
            'expcate_id' => $request['category'],
            'expense_date' => $request['date'],
            'expense_amount' => $request['amount'],
            'expense_creator' => $creator,
            'expense_slug' => $slug,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($insert) {
            return redirect('dashboard/expense')->with('success', 'expense Insert Successfully');
        } else {
            return redirect('dashboard/expense/add')->with('error', 'Opps, Something Is Wrong');
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

        $update = expense::where('expense_status', 1)->where('expense_id', $id)->update([
            'expense_title' => $request['title'],
            'expcate_id' => $request['category'],
            'expense_date' => $request['date'],
            'expense_amount' => $request['amount'],
            'expense_editor' => $editor,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($update) {
            return redirect('dashboard/expense')->with('success', 'expense Update Successfully');
        } else {
            return redirect('dashboard/expense/edit')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function softdelete()
    {
        $id = $_POST['modal_id'];
        $soft = Expense::where('expense_status', 1)->where('expense_id', $id)->update([
            'expense_status' => 0,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($soft) {
            return redirect('dashboard/expense')->with('success', 'expense Move To Trash Successfully');
        } else {
            return redirect('dashboard/expense')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function restore()
    {
        $id = $_POST['modal_id'];
        $restore = expense::where('expense_status', 0)->where('expense_id', $id)->update([
            'expense_status' => 1,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($restore) {
            return redirect('dashboard/expense/recycle')->with('success', 'expense Restore Successfully');
        } else {
            return redirect('dashboard/expense/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }

    public function delete()
    {
        $id = $_POST['modal_id'];
        $delete = expense::where('expense_status', 0)->where('expense_id', $id)->delete([]);

        if ($delete) {
            return redirect('dashboard/expense/recycle')->with('success', 'expense Permanently Successfully');
        } else {
            return redirect('dashboard/expense/recycle')->with('error', 'Opps, Something Is Wrong');
        }
    }
}
