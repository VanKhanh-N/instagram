<meta name="roomId" content="{{ $room }}">
@extends('direct.form') 
@section('conten') 
<div class="rights d-inline-block" style="height: 100%;width:65%;background-color: white; ">
   <div class="top-right position-relative ">
      <div class="user">
         <a href="#">
            <img src="{{ pare_url_file('ninja.jpg','user') }}"   class="rounded-circle ">
            <p>{{ $group_room->name}}</p>
         </a>
      </div>
      <a href="" class="info"><i class="fa fa-lg fa-info"></i></a>
      <a href="{{route('chat.video')}}" style="float:right;padding:25px"><i class="fa fa-lg fa-video-camera"></i></a>
   </div>
   <chat_group v-bind:chat_group="chat_group" v-bind:userid="{{ Auth::user()->id }}" v-bind:roomid="{{ $room }}"></chat_group>
</div>
@endsection