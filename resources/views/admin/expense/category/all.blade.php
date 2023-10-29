@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 breadcumb_part">
            <div class="bread">
                <ul>
                    <li><a href=""><i class="fas fa-home"></i>Home</a></li>
                    <li><a href=""><i class="fas fa-angle-double-right"></i>Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 card_title_part">
                            <i class="fab fa-gg-circle"></i>All Expense Category
                        </div>
                        <div class="col-md-4 card_button_part">
                            <a href="{{ url('dashboard/expense/category/add') }}" class="btn btn-sm btn-dark"><i
                                    class="fas fa-plus-circle"></i>Add Expense Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert_success" role="alert">
                            <strong>Success!</strong> {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert_error" role="alert">
                            <strong>Opps!</strong> {{ Session::get('error') }}
                        </div>
                    @endif
                    <table id="myTable" class="table table-bordered table-striped table-hover custom_table">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Remarks</th>
                                <th>slug</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expense_categories as $expense_category)
                                <tr>
                                    <td>{{ $expense_category->expcate_name }}</td>
                                    <td>{{ $expense_category->expcate_remarks }}</td>
                                    <td>{{ $expense_category->expcate_slug }}</td>
                                    <td>
                                        <div class="btn-group btn_group_manage" role="group">
                                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                                            <ul class="dropdown-menu">

                                                <li><a class="dropdown-item"
                                                        href="{{ url('dashboard/expense/category/view/' . $expense_category->expcate_slug) }}">View</a>
                                                </li>

                                                <li><a class="dropdown-item"
                                                        href="{{ url('dashboard/expense/category/edit/' . $expense_category->expcate_slug) }}">Edit</a>
                                                </li>

                                                <li><a class="dropdown-item" href="#" id="softDelete"
                                                        data-bs-toggle="modal" data-bs-target="#softDeleteModal"
                                                        data-id="{{$expense_category->expcate_id}}">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="btn-group" role="group" aria-label="Button group">
                        <button type="button" class="btn btn-sm btn-dark">Print</button>
                        <button type="button" class="btn btn-sm btn-secondary">PDF</button>
                        <button type="button" class="btn btn-sm btn-dark">Excel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Soft Delete Modal -->
    <div class="modal fade" id="softDeleteModal" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form method="post" action="{{url('dashboard/expense/category/softdelete')}}">
            @csrf
            <div class="modal-content modal_content">
              <div class="modal-header modal_header">
                <h1 class="modal-title modal_title fs-5" id="softDeleteModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h1>
              </div>
              <div class="modal-body modal_body">
                Are you want to sure delete data?
                <input type="hidden" name="modal_id" id="modal_id"/>
              </div>
              <div class="modal-footer modal_footer">
                <button type="submit" class="btn btn-sm btn-danger">Confirm</button>
                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </form>
        </div>
      </div>
@endsection
