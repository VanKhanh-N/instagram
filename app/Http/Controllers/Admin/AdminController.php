<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function index(){
        $month_now = Carbon::now()->month;
        $new_admin=Admin::whereMonth('created_at',$month_now)->count();
        $new_user=User::whereMonth('created_at',$month_now)->count();
        $new_post=Post::count();
        $viewData=[
            'new_admin'=>$new_admin,
            'new_user'=>$new_user,
            'new_post'=>$new_post,
            'title' =>'Trang quản trị',
        ];
        return view('admin.index',$viewData);
    }
}
