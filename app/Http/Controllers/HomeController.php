<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Pusher\Pusher;
use App\Models\User; 
use App\Models\Follow; 
use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;
class HomeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }

     
    public function index()
    {    
        //tất cả bài viết của những người bạn theo dõi
        $posts =Post::join('follows','follows.followed','posts.p_user')
                    ->where('follows.user_id',\Auth::id())
                    ->where('posts.p_type','profile')
                    ->select('posts.*')
                    ->limit(5)
                    ->get(); 
        $user =User::where('users.id','!=',\Auth::user()->id)->limit(5)->inRandomOrder()->get();  
        
        $data=[
            'posts' => $posts, 
            'user'  => $user,     
            'title' => 'Instagram'
        ];
        return view('welcome',$data);
    }
     
}
