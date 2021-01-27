@extends('admin.layout')
@section('content')
<div class="container-fluid" id="container-wrapper">
<div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Thêm vai trò</h6>
                </div>
                <div class="card-body">
                  <form method="post">
                  @csrf
                  <div class="form-group">
                      <label for="fe">Tên vai trò</label>
                      <input type="text" class="form-control" name="name" id="fe" value="{{$role->name}}" >
                      @if($errors->first('name'))    
                <span class="text-danger">{{$errors->first('name') }}</span>
                @endif
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlInput2">Mô tả vai trò</label>
                      <input type="text" class="form-control" name="display_name" id="exampleFormControlInput2"  >
                      @if($errors->first('display_name'))    
                <span class="text-danger">{{$errors->first('display_name') }}</span>
                @endif
                    </div>
                    <button class="btn btn-primary">Thêm vai trò</button>
                 
                  </form>
                </div>
              </div>
              </div>
@endsection