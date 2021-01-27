@extends('admin.layout')
@section('content') 
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Người dùng</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Trang chủ</a></li> 
              <li class="breadcrumb-item active" aria-current="page">Người dùng</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <a href="{{ route('admin.employee.create')}}">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Thêm người dùng</h6>
                </div>
                </a>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Admin</th>
                        <th>Vai trò</th> 
                        <th>Hành động</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($admin as $list)
                      <tr>
                        <td>{{ $list->id}}</td>
                        <td>{{ $list->name}}</td>
                        <td>
                        {{$list->roles}}
                        </td>
                        <td><a href="{{ route('admin.employee.update',$list->id)}}" class="btn btn-sm btn-primary">Cập nhật</a>
                        <a   data-title="Bạn có muốn xóa không ?" href="{{ route('admin.employee.delete',$list->id)}}" class="twitter btn btn-sm btn-danger">Xóa</a>
                        </td>
                      </tr>
                      @endforeach
                       
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
@endsection