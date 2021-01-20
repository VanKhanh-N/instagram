<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Pusher\Pusher;
use App\Models\User; 
use App\Models\Follow; 
use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;
use Carbon\Carbon;
class HomeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }

     
    public function index(Request $request)
    {    
        //tất cả bài viết của những người bạn theo dõi
        $posts =Post::join('follows','follows.followed','posts.p_user')
                    ->where('follows.user_id',\Auth::id())
                    ->where('posts.p_type','profile')
                    ->select('posts.*')
                    ->orderby('created_at','desc')
                    ->paginate(5); 
        $now =Carbon::now();
        if($request->ajax()){
        return ['posts'=>view('layout.welcome')->with(compact('posts','now'))->render(),'next_page'=>$posts->nextPageUrl()];
        }
        $user =User::where('users.id','!=',\Auth::id())->take(5)->inRandomOrder()->get();  
        
        $data=[
            'now'   => $now,
            'posts' => $posts, 
            'user'  => $user,     
            'title' => 'Instagram'
        ];
        return view('welcome',$data);
    }
     
}
