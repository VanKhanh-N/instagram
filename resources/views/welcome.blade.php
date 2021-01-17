@include('header') 
<body>
   <br>
   <br>
   <br>
   <div class="container">
   <div class="d-block">
      <div class="d-inline-block left border-gray">
         <section>
            <ul class="d-flex story position-relative mySlides">
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>26.imei     </div>
                  </a>
               </li>
            </ul>
         </section>
         @foreach($posts as $key => $item)  
         <article class="border-gray position-relative">
            <div class="header ">
               <a class="text-black" href="{{ $item->user->user}}"><img src="{{ pare_url_file($item->user->avatar,'user') }}" class="rounded-circle  d-inline-block img-user">{{ $item->user->c_name}}</a>
               <div class="float-right"><a><img src="{{ asset('img/edit.png') }}" class="img-edit"></a></div>
            </div>
            <img src="{{pare_url_file($item->p_image,'profile') }}" class="article-img">
            
            <div class="attractive">
               <div class="d-block">
                  <div class="d-inline-block"><i class="fa fa-15x heart{{$item->id}} {{ \App\Models\Like::checkLove($item->id) ? 'fa-heart text-red' :'fa-heart-o' }}" onclick="likepost('{{$item->id}}')"></i> </div>
                  <div class="d-inline-block"><i class="fa fa-15x fa-comment-o"></i></div>
                  <div class="d-inline-block"><i class="fa fa-15x fa-share-alt"></i></div>
                  <div class="d-inline-block float-right"> <i class="fa fa-15x fa-bookmark-o float-right"></i></div>
                  <br>
                    <b class="like{{$item->id}} zxm">{{\App\Models\Like::where('r_post',$item->id)->count()}} lượt thích</b>
                   <div class="d-inline-block w-100">
                     <div class="status">
                        <a href="{{ $item->user->user}}" class="text-black">{{$item->user->c_name}} </a>{{$item->p_content}} <br>    
                        <br>
                     </div>
                     <a href="" class="text-gray">Xem tất cả 4 bình luận</a> 
                      <div class="hdl{{$key}}">
                     @foreach(\App\Models\Comment::where('c_post',$item->id)->get() as $list) 
                     <div class="chat w-100 position-relative">
                        <a href="{{ $list->user->user}}" class="text-black">{{$list->user->c_name}}</a> {{ $list->c_comment}}
                        <i class="fa fa-heart-o float-right"></i> 
                     </div> 
                     <a href="" class="text-gray" style="font-size:12px;line-height:30px">1 NGÀY TRƯỚC</a><br>
                      @endforeach
                     </div>
                     <hr>
                     <form class="position-relative form" action="{{ route('comment.post')}}">
                        <textarea rows="10"  autocomplete="off" class="textarea-{{$key}} textarea-comment{{$key}}" placeholder="Thêm bình luận..."></textarea>
                        <input type="hidden" value="{{$item->id}}" class="post-comment{{$key}}">
                        <input type="hidden" value="{{\Auth::id()}}" class="user-comment{{$key}}">  
                        <input type="submit" class="os comment-submit submit-{{$key}} submit-comment{{$key}}" value="Đăng">
                     </form>
                  </div>
                  <div class="d-inline-block"></div>
               </div>
            </div>
         </article> 
         <script> 
         //yêu thích
         $(function(){ $('.heart{{$item->id}}').on('click',function(){
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
            data:{c_comment:c_comment,c_post:c_post,c_user_id:c_user_id}
         }).done(function(e){
            $(".hdl{{$key}}").append(`
            <div class="chat w-100 position-relative">
                        <a href="/${e.user.user}" class="text-black">${e.user.c_name}</a> ${c_comment}
                        <i class="fa fa-heart-o float-right"></i> 
                     </div> 
                     <a href="" class="text-gray" style="font-size:12px;line-height:30px">1 NGÀY TRƯỚC</a><br>
         `);
         $('.textarea-comment{{$key}}').val('');
         $('.submit-comment{{$key}}').addClass('disabled');
         });
      })
})
 
         </script>     
         @endforeach
      </div>
      <div class="d-inline-block right" >
         <div class="d-block">
            <div class="d-inline-block"><a href="{{\Auth::user()->user}}"><img src="{{ pare_url_file(\Auth::user()->avatar,'user') }}" class="rounded-circle w-50"></a></div>
            <div class="d-inline-block">
               <div class="user-link"><a href="{{\Auth::user()->user}}" class="text-black">{{ \Auth::user()->user}}</a></div>
               <div class="user-name" >
                  <p class="os"><a href="{{\Auth::user()->user}}">{{ \Auth::user()->c_name}}</a></p>
               </div>
            </div>
            <br><br>  
            <div class="d-flex w-100">
               <p class="text-gray w-100">Gợi ý cho bạn</p>
               <a href="" class="text-black float-right w-100" style="font-size:12px">Xem tất cả</a>
            </div>

            @foreach($user as $list)
            @if(!\App\Models\Follow::where(['user_id'=>\Auth::id(),'followed'=>$list->id])->count())
            <div class="d-inline-block position-relative suggest">
               <div class="d-inline-block">
               @if(substr($list->avatar,0,4)=='http')
                <a href="{{ route('get.home-page',$list->user) }}"><img src="{{ $list->avatar }}" class="rounded-circle"></a>
                @else
               <a href="{{ route('get.home-page',$list->user) }}"><img src="{{ pare_url_file($list->avatar,'user') }}" class="rounded-circle"></a>
                @endif  
               </div>   
               <div class="d-inline-block ">
                  <div class="w-100 user-link"><a href="{{ route('get.home-page',$list->user) }}" class="text-black">{{ $list->user}}</a></div>
                  <br>
                  @if(\App\Models\Follow::where(['user_id'=>$list->id,'followed'=>\Auth::id()])->count())
                  <div class="w-100 user-name">
                     <p class="text-gray">Theo dõi bạn</p>
                  </div>
                  @endif
               </div>
               <div class="d-inline-block" style="position: absolute; top: 0;right: 0;margin-top: 10px;">
                  <p class="cs follow{{$list->id}}  text-blue" onclick="follow('{{$list->id}}')">Theo dõi</p>
                  <div class="load{{$list->id}}" style="margin-top:-10px;display:none">
                  <img src="{{ asset('img/loading.gif')}}">
                  </div>
               </div>
            </div>
            <script>
            $(".follow{{$list->id}}").on("click",function(){ 
               $(this).toggleClass("text-blue");
            })
            </script>
            @endif
           @endforeach


            <div class="about-us">
               <ul style="width: 80%;line-height:20px;margin-top: 30px;font-size:12px;opacity: 0.5;">
                  <li class="d-inline-block "><a href="">Giới thiệu</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Trợ giúp</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Báo chí</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">API</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Việc làm</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Quyền riêng tư</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Điều khoản</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Vị trí</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Tài khoản liên quan nhất</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Hashtag</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="">Ngôn ngữ</a></li>
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
   <script src="https://use.fontawesome.com/452826394c.js"></script>
    
</body>
</html>