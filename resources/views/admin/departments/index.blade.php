@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Phòng ban</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Thiết lập</li>
          <!-- <li class="breadcrumb-item"><a href="{{ url('branch') }}">Settings</a></li> -->
          <li class="breadcrumb-item active">Phòng ban</li>
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
                        <div class="text-right">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#create" title="Add Department"><i class="fas fa-plus"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Thêm phòng ban</span></button>
                        </div>

                        <hr>
                        <div class="table-responsive">
                            <table id="departments" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>Tên</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $key => $department)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$department->department_name}}</td>
                                            <td class="text-center">
                                                @if($department->status == 'Active')
                                                    <div class="text-white badge badge-success font-weight-bold">Hoạt đồng</div>
                                                @else
                                                    <div class="text-white badge badge-danger font-weight-bold">Ngừng hoạt động</div>
                                                @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{ $department->id }}" title="Edit Department"> <i class="fas fa-pencil-alt text-white"></i></a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete{{ $department->id }}" title="Delete Department"> <i class="fas fa-trash-alt text-white"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="confirm-delete{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('department.delete' , $department->id )}}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Xóa phòng ban</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có muốn xóa phòng ban không "{{ $department->department_name }}"?
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Hủy bỏ</span></button>
                                                            <button  type="submit" class="btn btn-danger btn-ok" title="Delete Department"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-trash-alt"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Xóa</span></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="edit{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form id="editDepartmentForm{{$department->id}}" action="{{route('department.update',['id'=>$department->id])}}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Cập nhật phòng ban</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="control-label">Tên<span class="text-danger">*</span></label>
                                                                <input  type="text" name="department_name" value="{{old('department_name',$department->department_name)}}" placeholder="Enter Department Name" class="form-control" id="department_name{{$department->id}}" oninput="check('department_name'+{!! $department->id !!});">
                                                                <span id="department_name-error{{$department->id}}"  class="error invalid-feedback">Tên phòng ban là bắt buộc</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Status</label>
                                                                <select  name="status" class="form-control">
                                                                    <option value="Active" @if($department->status == 'Active') selected @endif>Hoạt động</option>
                                                                    <option value="InActive" @if($department->status == 'InActive') selected @endif>Ngừng hoạt động</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Hủy bỏ</span></button>
                                                            <button type="button" onclick="validate({!! $department->id !!});" class="btn btn-primary btn-ok" title="Update Department"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-check-circle"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cập nhật</span></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createDepartmentForm" action="{{route('department.create')}}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo phòng ban</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Tên<span class="text-danger">*</span></label>
                            <input  type="text" name="department_name" placeholder="Enter Department Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <select  name="status"  class="form-control">
                            <option value="Active">Hoạt động</option>
                            <option value="InActive">Ngừng hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Hủy bỏ</span></button>
                        <button  type="submit" class="btn btn-primary btn-ok" title="Create Department"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-check-circle"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Tạo</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Main Content End -->

<script>
    $(document).ready(function () {
        $('#departments').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(function () {
        $('#createDepartmentForm').validate({
            rules: {
                department_name: {
                    required: true
                }
            },
            messages: {
                department_name: "Department name is required"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    function validate(id)
    {
        if($("#department_name"+id).val() == '')
        {
            $('#department_name-error'+id).addClass('show');
            $('#department_name'+id).addClass('is-invalid');
        }
        else
        {
            $('#editDepartmentForm'+id).submit();
        }
    }

    function check(id)
    {
        if($('#'+id).val() != '')
        {
            $('#'+id).removeClass('show');
            $('#'+id).removeClass('is-invalid');
        }
        else
        {
            $('#'+id).addClass('show');
            $('#'+id).addClass('is-invalid');
        }
    }
</script>
@stop