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
                            <i class="fab fa-gg-circle"></i>All Income Category
                        </div>
                        <div class="col-md-4 card_button_part">
                            <a href="{{ url('dashboard/income/category/add') }}" class="btn btn-sm btn-dark"><i
                                    class="fas fa-plus-circle"></i>Add Category</a>
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
                    <table class="table table-bordered table-striped table-hover custom_table">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Remarks</th>
                                <th>slug</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($income_categories as $income_category)

                            <tr>
                                <td>{{$income_category->incate_name}}</td>
                                <td>{{$income_category->incate_remarks}}</td>
                                <td>{{$income_category->incate_slug}}</td>
                                <td>
                                    <div class="btn-group btn_group_manage" role="group">
                                        <button type="button" class="btn btn-sm btn-dark dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                                        <ul class="dropdown-menu">

                                            <li><a class="dropdown-item" href="{{url('dashboard/income/category/view/'.$income_category->incate_slug)}}">View</a></li>

                                            <li><a class="dropdown-item" href="{{ url('dashboard/user/edit') }}">Edit</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Delete</a></li>
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
@endsection
