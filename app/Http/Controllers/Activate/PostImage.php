<?php

namespace App\Http\Controllers\Activate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\CommentPost;
class PostImage extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function CommentPost(Request $request){  
        $data=$request->except('_token');
        $data['created_at']=Carbon::now();
        $data['updated_at']=Carbon::now(); 
        $id=Comment::InsertGetId($data);
        Post::where('id',$data['c_post'])->increment('p_comment');
        $post=Post::find($data['c_post']);
        $user=User::find(\Auth::id());
        User::find($post->user->id)->notify(new CommentPost($post,$user));
        return response([
            'count'=> Post::find($data['c_post']),
            'user'=>\Auth::user(), 
            'avatar' =>pare_url_file(\Auth::user()->avatar,'user')
            ]);
    }

    public function LikePost(Request $request){
        $data = $request->all();
        $count= Like::where(['r_post'=>$data['r_post'],'r_user_id'=>\Auth::user()->id ])->first();  
        if($count){  
            $count->delete();
            Post::where('id',$data['r_post'])->decrement('p_favourite'); 
            return Post::find($data['r_post']);
        } 
        $data['r_user_id']=\Auth::user()->id;
        $data['created_at']=Carbon::now();
        $data['updated_at']=Carbon::now();
        $id=Like::InsertGetId($data);
        Post::where('id',$data['r_post'])->increment('p_favourite');
        return Post::find($data['r_post']);
    }
}
