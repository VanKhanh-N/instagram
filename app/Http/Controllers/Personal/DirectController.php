<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
class DirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //chat private
    public function index(){ 
       
        $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',\Auth::id())
                ->orwhere('friend_id',\Auth::id());
        })
                ->get();       
        $viewData=[ 
            'chat' =>$chat,
            'title'=>'Message'
        ];
        return view('direct',$viewData);
    }
    public function show($id){ 
      $chat =Chat:: where('repeats',0)->where(function($user){
            $user ->where('user_id',\Auth::id())
                ->orwhere('friend_id',\Auth::id());
        })
                ->get();    
        $friend =User::FindorFail($id);
        $viewData=[
            'chat' => $chat,   
            'friend' => $friend,
            'title'  => 'Chat'
        ];
        return view('direct.chat',$viewData);
    }
    
    public function getChat($id) {
        $chats = Chat::where(function ($query) use ($id) {
            $query->where('user_id', '=', \Auth::user()->id)->where('friend_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('user_id', '=', $id)->where('friend_id', '=', \Auth::user()->id);
        })->get();
        $friend=User::find($id);
    $data=[
        'chat' =>$chats,
        'friend'=>$friend
    ];
        return $data;
    }

    public function sendChat(Request $request) { 
        $repeats =0;
        if(Chat::where(['user_id'=> $request->user_id, 'friend_id' => $request->friend_id])->count()) $repeats=1;
        if(Chat::where(['user_id' => $request->friend_id,'friend_id'=> $request->user_id ])->count()) $repeats=2;
        Chat::create([
            'user_id' => $request->user_id,
            'friend_id' => $request->friend_id,
            'chat' => $request->chat,
            'repeats'=>$repeats
        ]);
        
        return [];
    }
    public function searchmess(Request $request){ 
        if($request->value==''){
            $chat =Chat::where('user_id',\Auth::id())->groupBy('friend_id')->get();
            $output='';
            if(!$chat->isEmpty())
            $output.= view('direct.searchmess',compact('chat'))->render();
            else{
            $output= '';
            }
         return $output;
        }
       $val =User::where('c_name','like','%'.$request->value.'%')->orwhere('user','like','%'.$request->value.'%')->limit(5)->get();
       $output='';
       if(!$val->isEmpty())
       $output.= view('direct.searchmess',compact('val'))->render();
       else{
       $output= '<p class="pq os">Không có người dùng</p>';
       }
    return $output;
    }
    public function list_user(Request $request){

        $random_number =rand(0000000000,9999999999);
        $group = Group::create(['name' => 'Nhóm',
                                'room' => $random_number
        ]);
        if (is_array($request->user) || is_object($request->user))
{
        foreach($request->user as $list){
            if($list !=','){
                GroupUser::create([
                    'group_id' => $random_number,
                    'user_id'  => $list
                ]);
            }
        }
    }
        return route('chat.group.show',$random_number);
    }
    public function video(){
        return view('direct.videocall');
    }
    public function index_chat_group($room){ 
        $room =Group::where('room',$room)->first();
        $participants =GroupUser::where('group_id',$room->id)->get();
        $viewData=[ 
            
            'title'  => 'Group Chat'
        ];
        return view('direct.group_chat',$viewData);
    }
    public function chat_group() {
        $group = Group::create(['name' => request('name'),
                                'room' =>str_random(12)
        ]);

        $users = collect(request('users'));
        $users->push(auth()->user()->id);

        $group->users()->attach($users);

        broadcast(new GroupCreated($group))->toOthers();

        return $group;
    }
}
