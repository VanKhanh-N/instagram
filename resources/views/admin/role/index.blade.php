@extends('admin.layout')
@section('content') 
<style>
a{text-decoration:none}</style>
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vai trò</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Trang chủ</a></li> 
              <li class="breadcrumb-item active" aria-current="page">Vai trò</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <a href="{{ route('admin.role.create')}}">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Thêm vai trò</h6>
                </div>
                </a>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>vai trò</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       
                      @foreach($role as $list)
                      <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td> 
                        <td>
                        <a href="{{ route('admin.role.update',$list->id)}}" class="btn btn-sm btn-primary">Sửa</a>
                        <a href="{{ route('admin.role.delete',$list->id)}}" class="btn btn-sm btn-danger">Xoá</a></td>
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