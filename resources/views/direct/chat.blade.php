<meta name="friendId" content="{{ $friend->id }}">

@extends('header') 
@section('content') 
      <div class="messages  d-block">
        <div class="left d-inline-block" style="height: 100%;width:35%; ">
            <div class="top-left  position-relative">
                <p>{{ \Auth::user()->c_name}}</p>
                <img src="{{ asset('img/direct-message.png') }}">
            </div>
            <div class="bottom-left">
                <ul>   
                @if(!count(\App\Models\Chat::where(['user_id'=>\Auth::id(),'friend_id'=>$friend->id])->get())
                &&
                !count(\App\Models\Chat::where(['friend_id'=>\Auth::id(),'user_id'=>$friend->id])->get())
                )
                <a href="{{ route('chat.show', $friend->id) }}">
                    <li class="clr">
                            <img src="{{ pare_url_file($friend->avatar,'user') }}">
                            <p>{{ $friend->c_name}}</p><br>
                            <onlineuser v-bind:friend="{{$friend }}" v-bind:onlineusers="onlineUsers"></onlineuser>
                    </li> 
                </a> 
                @endif 
                
                @foreach($chat as $list)
                @php
                    $userr =$list->friends;
                    if( $list->friends->id == \Auth::id())
                    $userr =$list->users;
                @endphp
                <a href="{{ route('chat.show', $userr->id) }}">
                    <li class="clr" >
                        <img src="{{ pare_url_file($userr->avatar,'user') }}">
                        <p>{{ $userr->c_name}}</p>
                        <br>
                        <onlineuser v-bind:friend="{{ $userr }}" v-bind:onlineusers="onlineUsers"></onlineuser>  
                    </li>
                </a>
                @endforeach  
                </ul>
            </div>
        </div>
        
        <div class="rights d-inline-block" style="height: 100%;width:65%;background-color: white; ">
            
            <div class="top-right position-relative ">
               <div class="user">
                    <a href="{{route('get.home-page',$friend->user)}}">
                        <img src="{{ pare_url_file($friend->avatar,'user') }}"   class="rounded-circle ">
                    <p>{{ $friend->c_name}}</p>
                      <onlineuser v-bind:friend="{{ $friend }}" v-bind:onlineusers="onlineUsers"></onlineuser> 
                    </a>
               </div>
               <a href="" class="info"><i class="fa fa-lg fa-info"></i></a>
               <a href="" style="float:right;padding:25px"><i class="fa fa-lg fa-video-camera"></i></a>
            </div> 
           
            <chat v-bind:chats="chats" v-bind:userid="{{ Auth::user()->id }}" v-bind:friendid="{{ $friend->id }}" ></chat>
           
        </div>
      </div>  
       
@endsection