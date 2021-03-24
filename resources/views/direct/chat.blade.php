<meta name="friendId" content="{{ $friend->id }}">
@extends('direct.form')
@section('conten')
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
               <a href="{{route('chat.video')}}" style="float:right;padding:25px"><i class="fa fa-lg fa-video-camera"></i></a>
            </div> 
           
            <chat v-bind:chats="chats" v-bind:userid="{{ Auth::user()->id }}" v-bind:friendid="{{ $friend->id }}" ></chat>
           
        </div>
       
@endsection