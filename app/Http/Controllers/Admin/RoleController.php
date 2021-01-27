<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function index()
    {
        $role=Role::all();
        $viewData=[
            'role'  => $role,
            'title' =>'Vai trò',
        ];
        return view('admin.role.index',$viewData);
    }
    public function create()
    { 
        $viewData=[
        'title' =>'Thêm vai trò',
    ];
        return view('admin.role.create',$viewData);
    }
    public function store(Request $request)
    {
        $role =Role::where('name',$request->name)->first();
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên vai trò', 
            'display_name.required'=>'Bạn cần nhập mô tả vai trò', 
        ]); 
        $user=Role::create([
            'name' =>$request->name, 
            'display_name' =>$request->display_name, 
        ]);  
        return redirect()->route('admin.role.index');
    }
    public function update($id)
    { 
        $role=Role::find($id);
        $viewData=[
        'role'  =>$role,
        'title' =>'Thay đổi vai trò',
    ];
        return view('admin.role.update',$viewData);
    }
    public function edit(Request $request,$id)
    {
        $role=Role::find($id);
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên vai trò', 
            'display_name.required'=>'Bạn cần nhập mô tả vai trò', 
        ]);  
        $role->name=$request->name;
        $role->display_name=$request->display_name;
        $role->save();
        return redirect()->route('admin.role.index');
    }
    public function delete($id)
    {
        $role=Role::find($id);
        if($role) $role->delete();
        return redirect()->back();
    }
}
