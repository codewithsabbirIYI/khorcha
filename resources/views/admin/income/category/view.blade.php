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
                            <i class="fab fa-gg-circle"></i>Income Category Information
                        </div>
                        <div class="col-md-4 card_button_part">
                            <a href="{{ url('dashboard/user') }}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All
                                Income Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-striped table-hover custom_view_table">
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>{{ $data->incate_name }}</td>
                                </tr>
                                <tr>
                                    <td>Remarks</td>
                                    <td>:</td>
                                    <td>{{ $data->incate_remarks }}</td>
                                </tr>
                                <tr>
                                    <td>Slug</td>
                                    <td>:</td>
                                    <td>{{ $data->incate_slug }}</td>
                                </tr>
                                <tr>
                                    <td>Creator</td>
                                    <td>:</td>
                                    <td>{{ $data->creatorInfo->name }}</td>
                                </tr>
                                @if ($data->editorInfo != '')
                                    <tr>
                                        <td>Editor</td>
                                        <td>:</td>
                                        <td>{{ $data->editorInfo->name }}</td>
                                    </tr>
                                @endif
                                <tr>

                                    <td>Created Time</td>
                                    <td>:</td>
                                    <td>{{ $data->created_at->format('d-m Y | h:i:s A') }}</td>
                                </tr>
                                <tr>

                            </table>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
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