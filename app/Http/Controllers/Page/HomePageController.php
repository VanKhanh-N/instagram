<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;   
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Follow;
use Carbon\Carbon;
Carbon::setLocale('vi');
class HomePageController extends Controller
{ public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id){ 

        //$id là username có thể là Auth->user hoặc không  
        $user=User::where('user',$id)->first();  
        $post=Post::where(['p_user'=>$user['id'],
                           'p_type'=>'profile'])
                    ->orderBy('created_at','desc')
                   ->get();
                           
        $video=Post::where(['p_user'=>$user['id'],
                           'p_type'=>'video'])
                    ->orderBy('created_at','desc')
                    ->get();
            
        
        //số người đang theo dõi
        $areFollow =Follow::where(['user_id'=>$user['id']])->orderBy('created_at','desc')->get();
        //kiểm tra xem có theo dõi người khác hay không
        $isFollow =Follow::where(['user_id'=>\Auth::id(),'followed'=>$user['id']])->count();
        //đang theo dõi ai
        $userFollow =Follow::where('followed',$user['id'])->orderBy('created_at','desc')->get();
        $viewData=[  
            'now'        => Carbon::now('Asia/Ho_Chi_Minh'),
            'user'       => $user,
            'post'       => $post, 
            'title'      => $user['c_name'],
            'video'      => $video, 
            'followed'   => $isFollow,
            'areFollow'  => $areFollow,
            'userFollow' => $userFollow
        ];  
        return view('home-page',$viewData);
    } 
    public function saveProfile(Request $request){   
        $data=$request->except('_token','profiles','stories');  
        $data['created_at']=Carbon::now('Asia/Ho_Chi_Minh');
        $data['p_user']=\Auth::id(); 
        if($request->profiles){
            $image =upload_image('profiles',"profile");
            if($image['code']==1)
                $data['p_image']=$image['name'];
            $data['p_type']='profile';
            $id=Post::insertGetId($data);
            DB::table('users')->where('id',\Auth::user()->id)->increment('picture');
        }
        if($request->stories){
            $image =upload_image('stories','story');
            if($image['code']==1)
                $data['p_image']=$image['name'];
            $data['p_type']='story';
            $id=Post::insertGetId($data);
            DB::table('users')->where('id',\Auth::user()->id)->increment('story');
        }
        return redirect()->back();
    }
    public function uploadProfile(Request $request){
    $user =  User::find(\Auth::user()->id);   
    if ($request->hasFile('upload_user_avatar')) {
      $image =upload_image('upload_user_avatar','user');
      if($image['code']==1)
        $user->avatar=$image['name'];
    }
    if($user->update()){
       return  User::find(\Auth::user()->id);
    }else{
        return 700;
    }
}
    
    public function deleteProfile(Request $request){ 
        $user =  User::find(\Auth::user()->id); 
        $user->avatar='';  
        if($user->update()){
            echo 200;
        }else{
            echo 700;
        }
    }
    public function follow(Request $request){
        $data=$request->all();
        $data['user_id']=\Auth::user()->id;
        $data['created_at']=Carbon::now('Asia/Ho_Chi_Minh'); 
        $isFollow =Follow::where(['user_id'=>\Auth::user()->id,'followed'=>$data['followed']])->count();
        if($isFollow){
            Follow::where(['user_id'=>\Auth::user()->id,'followed'=>$data['followed']])->delete();
            User::where('id',$data['followed'])->decrement('follower');
            return response([
                'action'    => 'bot',
                'user'      => User::find($data['followed']),
                'auth'      => \Auth::user(),
                'followed'  => Follow::where('user_id',\Auth::id())->count(), 
                ]);
        }
        else{
            $id=Follow::insertGetId($data); 
            User::where('id',$data['followed'])->increment('follower');
            return response([
                'action'    => 'them',
                'user'      => User::find($data['followed']),
                'auth'      => \Auth::user(),
                'followed'  => Follow::where('user_id',\Auth::id())->count()
                ]);
        } 
    }
    public function incre_view(Request $request){
        Post::where('id',$request->post)->increment('p_view');
        return Post::find($request->post);
    }
}
