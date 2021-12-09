@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Nhân viên</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('employees') }}">Quản lý nhân viên</a></li>
                    <li class="breadcrumb-item active">Nhân viên</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Session Message Section Start -->
@include('layouts.partials.error-message')
<!-- Session Message Section End -->

<!-- Main Content Start -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title pt-2"> {{$active_employees}} Active / {{$employees->count()}} Nhân viên</h4>
                        <div class="text-right">
                            <button type="button" onclick="window.location.href='{{route('employee.create')}}'" class="btn btn-info btn-rounded" data-toggle="tooltip" title="Add Employee"><i class="fas fa-plus"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Thêm nhân viên</span></button>
                        </div>

                        <hr>

                        <div class="form-group d-flex justify-content-between">
                            <div></div>
                            <select class="form-control mb-3 col-md-3" id="filter">
                                <option value="select">Chọn nhân viên</option>
                                @foreach($filters as $filter)
                                <option value="{{$filter}}" @if($filter==$selectedFilter) selected @endif>{{ucfirst(trans($filter))}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table id="employees" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        @if(count($employees) > 0)
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại </th>
                                        <th>Vị trí</th>
                                        <th>Branch</th>
                                        <th>Phòng ban</th>
                                        <th>Ngày tham gia</th>
                                        <th>Trạng thái nhân viên</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$employee->firstname}} {{$employee->lastname}}</td>
                                        <td>{{$employee->official_email}}</td>
                                        <td>{{$employee->contact_no}}</td>
                                        <td>{{ ucfirst(trans($employee->designation))}}</td>
                                        <td>{{isset($employee->branch) ? $employee->branch->name : ''}} ({{$employee->branch->address}})</td>
                                        <td>{{isset($employee->department) ? $employee->department->department_name : ''}}</td>
                                        <td>{{$employee->joining_date}}</td>
                                        <td>{{$employee->employment_status}}</td>
                                        <td class="text-nowrap">
                                            <a class="btn btn-warning btn-sm" href="{{route('employee.edit',['id'=>$employee->id])}}" data-toggle="tooltip" title="Edit Employee"> <i class="fas fa-pencil-alt text-white"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete{{ $employee->id }}" title="Delete Employee"> <i class="fas fa-trash-alt text-white"></i> </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="confirm-delete{{$employee->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('employee.destroy' , $employee->id)}}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Xóa nghỉ phép</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có muốn xóa nhân viên này không ?
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Hủy bỏ</span></button>
                                                        <button  type="submit" class="btn btn-danger btn-ok" title="Delete Employee"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-trash-alt"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Xóa</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach @else
                                    <tr> Không tìm thấy nhân viên</tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content End -->
<script>
    $(document).ready(function() {
        $('#employees').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(document).ready(function() {
        $("#filter").change(function(e) {
            if ($(this).val() === "select") {
                var url = "{{route('employees')}}/"
            } else {
                var url = "{{route('employees')}}/" + $(this).val();
            }

            if (url) {
                window.location = url;
            }
            return false;
        });
    });

    $("input.zoho").click(function(event) {
        if ($(this).is(":checked")) {
            $("#div_" + event.target.id).show();
        } else {
            $("#div_" + event.target.id).hide();
        }
    });
</script>
@stop