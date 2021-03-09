
@extends('header') 
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick/slick.css') }}"/>  
<body>
   <div class="container">
   <div class="d-block">
      <div class="d-inline-block left border-gray">
         <section>
            <ul class="d-flex story position-relative mySlides">
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
            </ul>
         </section>
         <div class="postss conntent">
         @if(!count($posts))
         <div class="d-block text-center cs" style="margin-top:30%" id="myBtn-5">
         <i class="fa fa-lg fa-plus-square-o" style="font-size:400%"></i>
         <p>{{ __('translate.Start following other people to share memories')}}</p>
      </div>
       <!-- modal user image -->
       <div class="suggest-follow">
       <div id="myModal-5" class="modal">
         <div class="modal-content setting animate__animated animate__zoomIn" >
            <li ><label style="width:70%">{{ __('translate.Suggestions For You')}}</label> <div class="float-right cs" style="font-size: 30px;padding: 9px 16px;" id="exit5">&times;</div></li>


            @foreach($user as $list)
            @if(!\App\Models\Follow::where(['user_id'=>\Auth::id(),'followed'=>$list->id])->count())
            <div class="d-inline-block position-relative suggest" >
               <div class="d-inline-block text-black">
                  <a href="{{ route('get.home-page',$list->user) }}"><img src="{{ pare_url_file($list->avatar,'user') }}" class="rounded-circle">
                  {{ $list->user}}
               </a>
                 
               </div>
               <div class="d-inline-block float-right" style="padding:10px">
                  <p class="cs follow{{$list->id}}  text-blue" onclick="follow('{{$list->id}}')">{{ ucwords(__('translate.follow'))}}</p>
                  <div class="load{{$list->id}}" style="margin-top:-10px;display:none">
                     <img src="{{ asset('img/loading.gif')}}">
                  </div>
               </div>
            </div>
            
            @endif
             
            @endforeach

         </div>
      </div>
      </div>
      @endif
            @foreach($posts as $key => $val)  
            <article class="border-gray position-relative">
               <div class="header ">
                  <a class="text-black" href="{{ $val->user->user}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="rounded-circle  d-inline-block img-user">{{ $val->user->c_name}}</a>
                 <div class="float-right">
                 @include('layout.infomation',['value'=>$val->id])</div>
               </div>
               <img src="{{pare_url_file($val->p_image,'profile') }}" class="article-img">
               <div class="attractive">
                  <div class="d-block">
                     <div class="d-inline-block"><i class="fa fa-15x heart{{$val->id}} {{ \App\Models\Like::checkLove($val->id) ? 'fa-heart text-red' :'fa-heart-o' }}" onclick="likepost('{{$val->id}}')"></i> </div>
                     <div class="d-inline-block"><i class="fa fa-15x fa-comment-o"></i></div>
                     <div class="d-inline-block"><i class="fa fa-15x fa-share-alt"></i></div>
                     <div class="d-inline-block float-right"> <i class="fa fa-15x fa-bookmark-o float-right"></i></div>
                     <br>
                     <b class="zxm"> <b class="like{{$val->id}}">{{\App\Models\Like::where('r_post',$val->id)->count()}}</b> {{ __('translate.likes')}}</b>
                     <div class="d-inline-block w-100">
                        <div class="status">
                           <a href="{{ $val->user->user}}" class="text-black">{{$val->user->c_name}} </a>{{$val->p_content}} <br>    
                           <br>
                        </div>
                        <div class="hdl{{$key}}">
                           @foreach(\App\Models\Comment::where('c_post',$val->id)->get() as $value=> $list) 
                           <div class="chat w-100 position-relative hjk{{$value}}" style="display:none">
                              <a href="{{ $list->users->user}}" class="text-black">{{$list->users->c_name}}</a> {{ $list->c_comment}}
                              <i class="fa fa-heart-o float-right"></i> 
                           </div>
                           @endforeach
                        </div>
                        <a href="javascript:;" class="text-gray button{{$key}}">{{ __('translate.View more comments')}}</a> 
                        <br>
                        <a href="" class="text-gray" style="font-size:12px;line-height:30px">{{ $val->created_at->diffForHumans($now) }} </a>
                        <hr>
                        <form class="position-relative form" action="{{ route('comment.post')}}">
                           <textarea rows="10"  autocomplete="off" class="textarea-{{$key}} textarea-comment{{$key}}" placeholder="{{ __('translate.Add a comment')}}..."></textarea>
                           <input type="hidden" value="{{$val->id}}" class="post-comment{{$key}}">
                           <input type="hidden" value="{{\Auth::id()}}" class="user-comment{{$key}}">  
                           <input type="submit" class="os comment-submit submit-{{$key}} submit-comment{{$key}}" value="{{ __('translate.Post')}}">
                           <img src="{{ asset('img/loading.gif')}}" class="w-30 loading{{$key}}" style="display:none;position: absolute;right: 0;">
                        </form>
                     </div>
                     <div class="d-inline-block"></div>
                  </div>
               </div>
            </article>
            <script> 
            $(function(){
               //load comment
                 
               $('body').on('click','.button{{$key}}',function(){  
                  
                  loadmore({{$key}});
               }) 
               currentindex=0;
               maxindex ="{{\App\Models\Comment::where('c_post',$val->id)->count()}}";
               function loadmore(id){  
                  if(currentindex+3 >= maxindex){
                     $('.button'+id).hide();
                  }
                  x=  window.scrollY;
                  var maxresult = 3;
               
                  for(var i = 0; i < maxresult; i++)
                     {
                        $('.hjk'+(currentindex+i)).show();
                     }
                
                    window.scrollTo(0,x);
                     currentindex += maxresult;
               }
               
                 loadmore({{$key}});
               //yêu thích
               $(function(){ $('.heart{{$val->id}}').on('click',function(){
                     $(this).toggleClass('text-red');
                     $(this).toggleClass('fa-heart-o ');
                     $(this).toggleClass('fa-heart');
               }); 
               //event comment
                  $('.textarea-{{$key}}').on('keyup',function(){
                     if(!$('.textarea-{{$key}}').val()){
                     $('.submit-{{$key}}').addClass('disabled'); 
                     $('.submit-{{$key}}').addClass('os'); 
                     }
                     else{ 
                     $('.submit-{{$key}}').removeClass('disabled');
                     $('.submit-{{$key}}').removeClass('os');
                     }
                  })
                   
                     //comment
               $(".submit-comment{{$key}}").on('click',function(e){
               e.preventDefault();
               var URL= $(this).parents('form').attr('action');
               var c_comment=$('.textarea-comment{{$key}}').val();
               var c_post=$('.post-comment{{$key}}').val();
               var c_user_id=$('.user-comment{{$key}}').val(); 
               
               $.get({ 
                  url:URL,
                  data:{c_comment:c_comment,c_post:c_post,c_user_id:c_user_id},
                  beforeSend:function(){
                     $('.loading{{$key}}').show();
                     $('.submit-{{$key}}').addClass('os');
                  },
                  complete:function(){
                     $('.loading{{$key}}').hide();
                     $('.submit-{{$key}}').removeClass('os');
                  }
               }).done(function(e){
                  $(".hdl{{$key}}").append(`
                  <div class="chat w-100 position-relative">
                              <a href="/${e.user.user}" class="text-black">${e.user.c_name}</a> ${c_comment}
                              <i class="fa fa-heart-o float-right"></i> 
                           </div>  
               `);
               $('.textarea-comment{{$key}}').val('');
               $('.submit-comment{{$key}}').addClass('disabled');
               });
               })
               })
            })
            </script>     
            @endforeach
         </div>
         <!-- <div class="loading" style="text-align:center">
            <img src="{{asset('img/loadingg.gif')}}"style="width:250px;height:250px">
         </div> -->
      </div>
      <div class="d-inline-block right" >
      
         <div class="d-block">
            <div class="d-inline-block"><a href="{{\Auth::user()->user}}">  
               @if(substr(auth()->user()->avatar,0,4)=='http')
               <img src="{{ auth()->user()->avatar }}" class="rounded-circle w-50">
               @else
               <img src="{{ pare_url_file(auth()->user()->avatar,'user') }}" class="rounded-circle w-50">
               @endif </a>
            </div>
            <div class="d-inline-block">
               <div class="user-link"><a href="{{\Auth::user()->user}}" class="text-black">{{ \Auth::user()->user}}</a></div>
               <div class="user-name" >
                  <p class="os"><a href="{{\Auth::user()->user}}">{{ \Auth::user()->c_name}}</a></p>
               </div>
            </div>
            <br><br>  
            <div class="d-flex">
               <p class="text-gray">{{ __('translate.Suggestions For You')}}</p>
               <a href="" class="text-black fs-12" style="text-align:right;width:68%">{{ __('translate.See All')}}</a>
            </div>
            @foreach($user as $list)
            @if(!\App\Models\Follow::where(['user_id'=>\Auth::id(),'followed'=>$list->id])->count())
            <div class="d-inline-block position-relative suggest">
               <div class="d-inline-block text-black">
                  <a href="{{ route('get.home-page',$list->user) }}"><img src="{{ pare_url_file($list->avatar,'user') }}" class="rounded-circle">
                  {{ $list->user}}</a>
               </div> 
               <div class="d-inline-block" style="position: absolute; top: 0;right: 0;margin-top: 10px;">
                  <p class="cs follow{{$list->id}}  text-blue" onclick="follow('{{$list->id}}')">{{ ucwords(__('translate.follow'))}}</p>
                  <div class="load{{$list->id}}" style="margin-top:-10px;display:none">
                     <img src="{{ asset('img/loading.gif')}}">
                  </div>
               </div>
            </div>
            
            @endif
             
            @endforeach
            <div class="about-us">
               <ul style="line-height:20px;margin-top: 30px;font-size:12px;opacity: 0.5;">
                  <li class="d-inline-block "><a href="">{{ __('translate.About')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">{{ __('translate.Help')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">{{ __('translate.Press')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">API</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">{{ __('translate.Jobs')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">{{ __('translate.Privacy')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">{{ __('translate.Terms')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">{{ __('translate.Locations')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">{{ __('translate.Top Accounts')}}</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Hashtag</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="{{route('language',['en']) }}">English</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="{{route('language',['vi']) }}">Tiếng Việt</a></li>
               </ul>
               <br>
            </div>
            <p class="text-gray" style="font-size:12px">&copy; 2020 INSTAGRAM FROM FACEBOOK</p>
         </div>
      </div>
   </div>
<script type="text/javascript" src="{{ asset('slick/slick/slick.js') }}"></script>
<script src="{{ asset('js/style.js') }}"></script>
<script src="{{ asset('js/post.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
   
  
</body>
@endsection