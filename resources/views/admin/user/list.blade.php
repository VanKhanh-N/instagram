@extends('admin.layout')
@section('content') 
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Người dùng</h1>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card"> 
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
                    @foreach($user as $list)
                      <tr>
                        <td>{{ $list->user}}</td>
                        <td>{{ $list->picture}}</td>
                        <td>{{ $list->email}}</td>
                        <td>
                        @if($list->is_active==0)
                        <span>Chưa kích hoạt</span>
                        @elseif($list->is_active==1)
                        <a href="{{route('admin.user.block',$list->id) }}">Đã kích hoạt</a>
                        @else
                        <a href="{{route('admin.user.block',$list->id) }}" class="text-danger">Đã bị khóa</a>
                        @endif
                        </td>  
                      </tr>
                      @endforeach
                       
                    </tbody>
                  </table>
                </div>
                
              </div>
              
            </div>
          </div>
          <!--Row-->
  
        </div>

@endsection