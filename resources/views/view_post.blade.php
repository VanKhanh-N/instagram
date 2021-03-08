<title>Bài viết của {{$val->user->c_name}}</title>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="title" content="{{$val->user->c_name}}">
   <meta name="description" content="{{$val->p_content}}">
    
   <meta name="url" property="og:url" content="{{  route('post.view',$val->p_slug) }}">
   <meta name="type" property="og:type" content="website" />
   <meta name="title" property="og:title" content="{{$val->p_content}}">
   <meta name="image" property="og:image" content="{{$val->p_image}}">

   <meta property="twitter:card" content="summary_large_image">
   <meta name="title" property="twitter:title" content="{{$val->p_content}}">
   <meta name="image" property="twitter:image" content="{{$val->p_image}}">
   <meta name="url" property="twitter:domain" content="{{route('post.view',$val->p_slug) }}">

   <meta property="zalo:card" content="summary_large_image">
   <meta name="title" property="zalo:title" content="{{$val->p_content}}">
   <meta name="image" property="zalo:image" content="{{$val->p_image}}">
   <meta name="url" property="zalo:domain" content="{{   route('post.view',$val->p_slug) }}">
   <link rel="stylesheet" href="{{ asset('css/view_post.css') }}"> 
 
@include('header')  
   <div class="asd">
      <img src="{{ pare_url_file($val->p_image,'profile') }}" class="asa"> 
      <div class="ass">
         <div class="heq">
            <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
               <div class="hee">
                  <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}} </a></b></p>
               </div>
            @include('layout.infomation',['value'=>$val->id])

            </div>
            
         <div class="her hdl{{$val->id}}" id="hell">
            
            @if($val->p_content!='')
               <div class="clr het">

                  <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>

                  <div class="hep">
                     <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}}</a> </b> {{$val->p_content}}</p>
                  </div>

                  <i class="fa fa-ellipsis-h"></i> 

                  <div class="os heo">{{ $val->created_at->diffForHumans($now) }}</div>
               </div>
            @endif   
            <div class="list-comment{{$val->id}}">
               @foreach(\App\Models\Comment::where('c_post',$val->id)->orderBy('created_at','desc')->get() as $value => $cmt)  
                  <div class="clr het hjk{{$value}} "  style="display:none">
                     <div class="hew"><a href="{{ route('get.home-page',$cmt->users->user)}}"><img src="{{ pare_url_file($cmt->users->avatar,'user') }}" class="{{ $cmt->c_user_id ==\Auth::id() ? 'avatar_user_uploaded' :''}}"></a></div>
                     <div class="hep">
                        <p><b><a href="{{ route('get.home-page',$cmt->users->user)}}">{{$cmt->users->c_name}}</a></b>{{ $cmt->c_comment}}</p>
                     </div>
                     <i class="fa fa-ellipsis-h"></i>
                     <div class="os heo">{{ $cmt->created_at->diffForHumans($now) }} </div>
                  </div>
               @endforeach
            </div>
            <div class="buttons"><button class="button{{$val->id}} ">+</button> </div>
            <script>
               $('.button{{$val->id}}').on('click',function(){  
                     loadmore(); 
               }) 
               currentindex=0;
               maxindex ="{{\App\Models\Comment::where('c_post',$val->id)->count()}}";
               function loadmore(){ 
               x=  window.scrollY;
               var maxresult = 5;
               
               for(var i = 0; i < maxresult; i++)
               {
                  $(".hjk"+(currentindex+i)).show();
               }
               if(currentindex+5>=maxindex){
                  $('.button{{$val->id}}').hide();
               }
               window.scrollTo(0,x);
               currentindex += maxresult;
               
               }
               
               loadmore();
            </script>
         </div>
         @php
            $class=" fa-heart-o ";
            if(\App\Models\Like::checkLove($val->id))
            $class="fa-heart text-red";
         @endphp
         <div class="hey">
            <i class="fa fa-15x heart {{ $class }}" onclick="likepost('{{$val->id}}')"></i> 
            <i class="fa fa-15x fa-comment-o"></i> 
            <i class="fa fa-15x fa-share-alt"></i>
            <i class="fa fa-15x fa-bookmark-o float-right"></i><br>
            <p class="asf "><b class="view">{{$val->p_view}}</b> {{ __('translate.views')}}</p>
            <p class="asf "><b class="likes{{$val->id}}">{{$val->p_favourite}}</b> {{ __('translate.likes')}}</p>
            <p class="os">4 giờ trước</p>
         </div>
         <script> 
            $('.heart').on('click',function(){
               $(this).toggleClass('text-red');
               $(this).toggleClass('fa-heart-o ');
               $(this).toggleClass('fa-heart');
            }) 
         </script>
         <div class="heu">
            <form action="{{ route('comment.post')}}" method="get">
               @csrf
               <textarea class="textarea"  placeholder="{{ __('translate.Add a comment')}}..."></textarea>
               <input type="hidden" value="{{$val->id}}" class="comments">   
               <button class="submit disabled" type="button">{{ __('translate.Post')}}</button>
               <img src="{{ asset('img/loading.gif')}}" class="w-30 load-comment" style="top: 10px;right: 15px;position: absolute;display:none;">
            </form>
         </div>
      </div>
   </div>
</div>
</div>   

<script>   
   //click để scroll đến cuối trang
      // $('body').on('click','#myBtnn{{$val->id}}',function(){
      //    var $div = $("#hell"); 
      //    $div.scrollTop($div[0].scrollHeight);
      // })
      //không cho người dùng đăng khi chưa comment
      $('.textarea').on('keyup',function(){
         if(!$('.textarea').val())
         $('.submit').addClass('disabled'); 
         else{ 
         $('.submit').removeClass('disabled');
         }
      })
      //hiện modal bài viết 
      
      var post='{{$val->id}}';
      var URL ="{{ route('post.increview')}}";  
      $.get({
         url:URL,
         data:{post:post},
         success:function(e){  
            $('.view{{$val->id}}').text(e.p_view);
         }
      })
      
      //hiện modal bài viết 
    
      var modal = document.getElementById("Modal"); 
      var btn = document.getElementById("Btns");
      var exits = document.getElementById("exits"); 
      btn.onclick = function() {
      modal.style.display = "block";
      }   
      //ẩn modal trong bài viết
      window.onclick = function(event) {   
         if (event.target == modal) {    
         modal.style.display = "none";
         }
      }
      exits.onclick = function(event) {   
         modal.style.display = "none";
      }
   
      //comment
      $(".submit").on('click',function(e){
      e.preventDefault();
      var URL= $(this).parents('form').attr('action');
      var c_comment=$('.textarea').val();
      var c_post=$('.comments').val();
      var c_user_id='{{ \Auth::id()}}'; 
      $.get({ 
      url:URL,
      data:{c_comment:c_comment,c_post:c_post,c_user_id:c_user_id},
      beforeSend:function(){
         $('.load-comment').show();
         $('.submit').hide();
      },
      complete:function(){
         $('.load-comment').hide();
         $('.submit').show();
      }
      }).done(function(e){
         
      $('.comment{{$val->id}}').text(e.count.p_comment);
      $(".list-comment{{$val->id}}").prepend(`
      <div class="clr het">
      <div class="hew"><a href="/${e.user.user}"><img src="${e.avatar}" class="avatar_user_uploaded"></a> </div>
      <div class="hep"><p><b><a href="/${e.user.user}">${e.user.c_name}</a> </b>${c_comment}</p></div>
      <i class="fa fa-ellipsis-h"></i>
      <div class="os heo">1 giây trước </div>
      </div>
      `);
      $('.textarea').val('');
      $('.submit').addClass('disabled');
   
      // var $div = $("#hell"); 
      // $div.scrollBottom($div[0].scrollHeight); 
      });
      })
      
      
</script>
<br>
@if(count($related_post))
<hr><br>
<div class="hr">  
      <p style="margin-left:20px">Thêm các bài viết từ <a href="{{route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}}</b></a></p>
      <br>
      <div class="clr">
         @foreach($related_post as $key=> $val) 
         <a href="{{route('post.view',$val->p_slug)}}">
         <div class="cs cse">
            <div class="clr csf">
               <i class="fa fa-heart"></i> <p class="likes{{$val->id}}">{{ $val->p_favourite}}</p>
               <i class="fa fa-comment"></i> <p class="comment{{$val->id}}"> {{$val->p_comment }}</p>
            </div>
            <img src="{{ pare_url_file($val->p_image,'profile') }}"  id="image{{$key}}">  
         </div>
         </a>
         @endforeach
      </div>
</div>
@endif
<footer> 
   <ul class="fs-13">
      <li class=" "><a href="">{{ __('translate.About')}}</a></li>
      <li class=" "><a href="">Blog</a></li>
      <li class=" "><a href="">{{ __('translate.Jobs')}}</a></li>
      <li class=" "><a href="">{{ __('translate.Help')}}</a></li>
      <li class=" "><a href="">API</a></li>
      <li class=" "><a href="">{{ __('translate.Privacy')}}</a></li>
      <li class=" "><a href="">{{ __('translate.Terms')}}</a></li>
      <li class=" "><a href="">{{ __('translate.Top Accounts')}}</a></li>
      <li class=" "><a href="">Hashtag</a></li>
      <li class=" "><a href="">{{ __('translate.Locations')}}</a></li>
      <li class=" "><a href="{{route('language',['vi']) }}">Tiếng Việt</a></li>
      <li class=" "><a href="{{route('language',['en']) }}">English</a></li>
   </ul>
   <br> 
</footer> 
<script src="{{ asset('js/post.js') }}"></script> 
