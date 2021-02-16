<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use DB;
class RoleController extends Controller
{
    private $role,$permission;
    public function __construct(Role $role,Permission $permission)
    {
       $this->role=$role;
       $this->permission=$permission;
    }
    public function index()
    {
        $role=$this->role->orderBy('id','asc')->paginate(10);
        $role_count=DB::table('role_user')->where('user_id',\Auth::guard('admins')->user()->id)->count();
         
        $viewData=[
            'role_count'=>$role_count,
            'role'  => $role,
            'title' =>'Phân quyền',
        ];
        return view('admin.role.index',$viewData);
    }
    public function create()
    { 
        $role=$this->role->all();
        $permissionParent=$this->permission->where('parent_id', null)->get();
        $viewData=[
            'role'  => $role,
            'permissionParent'  => $permissionParent,
            'title' =>'Thêm quyền hạn',
    ];
        return view('admin.role.create',$viewData);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên quyền hạn', 
            'display_name.required'=>'Bạn cần nhập mô tả quyền hạn', 
        ]); 
        $role=$this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('admin.role.index');
    }
    public function update($id)
    { 
        $role=$this->role->find($id);
        $permissionParent=$this->permission->where('parent_id', null)->get();
        $permissionChecked=$role->permissions;
        $viewData=[
        'role'  =>$role,
        'permissionParent'=>$permissionParent,
        'permissionChecked'=>$permissionChecked,
        'title' =>'Thay đổi quyền hạn',
    ];
        return view('admin.role.update',$viewData);
    }
    public function edit(Request $request,$id)
    {
        $role=$this->role->find($id);
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên quyền hạn', 
            'display_name.required'=>'Bạn cần nhập mô tả quyền hạn', 
        ]);   
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('admin.role.index');
    }
    public function delete($id)
    {
        $role=$this->role->find($id);
        \DB::table('permission_role')->where('role_id',$id)->delete();
        if($role) $role->delete();
        return redirect()->back();
    }
}
