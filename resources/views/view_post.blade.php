<title>Bài viết của {{\Auth::user()->c_name}}</title>
<style>
   .csg{
   margin-top:90px !important;
   width: 60%!important;
   position:relative !important;
   margin-left: 20%!important;
   border:1px solid #bdbdbd;
   }
   .csq{
   float: left!important;
   width: 65%!important;
   height: 100%!important;
   object-fit: cover!important;
   }
   .cle{
   width:35%!important
   }
   .f-6 {
   width: 50% !important;
   float: left!important;
   }
   hr,.hr{
      width:70%;
      margin:0 auto
   }
   footer{width:90%;
      margin:0 auto
   }
   footer ul{font-size:13px !important}
</style>
@include('header')   
   <div class="csg">
      <img src="{{ pare_url_file($post->p_image,'profile') }}" class="csq"> 
      <div class="cle">
         <div class="heq">

            <div class="hew"><a href="{{ route('get.home-page',$post->user->user)}}"><img src="{{ pare_url_file($post->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
              
               <div class="hee">
                  <p><a href="{{ route('get.home-page',$post->user->user)}}"><b>{{$post->user->c_name}} </a></b>
                  </p>
               </div>

               <i class="fa fa-ellipsis-h" id="Btns"></i>

               <div id="Modal" class="modal">
                  <div class="modal-content setting animate__animated animate__zoomIn" >
                     <li><a href="javascript:;" class="text-red">Báo cáo</a></li>
                     <li><a href="javascript:;" >Chia sẻ lên...</a></li>
                     <li><a href="javascript:;" >Sao chép liên kết</a></li>
                     <li class="cs" id="exits"><a href="javascript:;" >{{ __('translate.Cancel')}}</a></li>
                  </div>
               </div>
            </div>
         <div class="her hdl{{$post->id}}" id="hell">
            @if($post->p_content!='')
               <div class="clr het">

                  <div class="hew"><a href="{{ route('get.home-page',$post->user->user)}}"><img src="{{ pare_url_file($post->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>

                  <div class="hep">
                     <p><a href="{{ route('get.home-page',$post->user->user)}}"><b>{{$post->user->c_name}}</a> </b> {{$post->p_content}}</p>
                  </div>

                  <i class="fa fa-ellipsis-h"></i> 

                  <div class="os heo">{{ $post->created_at->diffForHumans($now) }}</div>
               </div>
            @endif   
            <div class="list-comment{{$post->id}}">
               @foreach(\App\Models\Comment::where('c_post',$post->id)->orderBy('created_at','desc')->get() as $value => $cmt)  
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
            <div class="buttons"><button class="button{{$post->id}} ">+</button> </div>
            <script>
               $('.button{{$post->id}}').on('click',function(){  
                     loadmore(); 
               }) 
               currentindex=0;
               maxindex ="{{\App\Models\Comment::where('c_post',$post->id)->count()}}";
               function loadmore(){ 
               x=  window.scrollY;
               var maxresult = 5;
               
               for(var i = 0; i < maxresult; i++)
               {
                  $(".hjk"+(currentindex+i)).show();
               }
               if(currentindex+5>=maxindex){
                  $('.button{{$post->id}}').hide();
               }
               window.scrollTo(0,x);
               currentindex += maxresult;
               
               }
               
               loadmore();
            </script>
         </div>
         @php
            $class=" fa-heart-o ";
            if(\App\Models\Like::checkLove($post->id))
            $class="fa-heart text-red";
         @endphp
         <div class="hey">
            <i class="fa fa-15x heart {{ $class }}" onclick="likepost('{{$post->id}}')"></i> 
            <i class="fa fa-15x fa-comment-o"></i> 
            <i class="fa fa-15x fa-share-alt"></i>
            <i class="fa fa-15x fa-bookmark-o float-right"></i><br>
            <p class="f-6 "><b class="view">{{$post->p_view}}</b> {{ __('translate.views')}}</p>
            <p class="f-6 "><b class="likes{{$post->id}}">{{$post->p_favourite}}</b> {{ __('translate.likes')}}</p>
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
               <textarea class="textarea" placeholder="{{ __('translate.Add a comment')}}..."></textarea>
               <input type="hidden" value="{{$post->id}}" class="comments">   
               <button class="submit disabled">{{ __('translate.Post')}}</button>
               <img src="{{ asset('img/loading.gif')}}" class="w-30 load-comment" style="top: 10px;right: 15px;position: absolute;display:none;">
            </form>
         </div>
      </div>
   </div>
</div>
<script>   
   //click để scroll đến cuối trang
      // $('body').on('click','#myBtnn{{$post->id}}',function(){
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
      
      var post='{{$post->id}}';
      var URL ="{{ route('post.increview')}}";  
      $.get({
         url:URL,
         data:{post:post},
         success:function(e){  
            $('.view{{$post->id}}').text(e.p_view);
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
         console.log(2);
      e.preventDefault();
      var URL= $(this).parents('form').attr('action');
      var c_comment=$('.textarea').val();
      var c_post=$('.comments').val();
      var c_user_id='{{ \Auth::id()}}'; 
      console.log(URL);
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
         
      $('.comment{{$post->id}}').text(e.count.p_comment);
      $(".list-comment{{$post->id}}").prepend(`
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
</div>
@if(count($related_post))
<hr><br>
<div class="hr">  
      <p>Thêm các bài viết từ <a href="{{route('get.home-page',$post->user->user)}}"><b>{{$post->user->c_name}}</b></a></p>
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
   <ul>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/post.js') }}"></script> 
