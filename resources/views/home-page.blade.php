@include('header')
<style>.user{margin-left:150px}</style>
<br> 
<br>
<br> 
<body>
   <section class="sd">
      <div class="img">
      @if(!$user->avatar) 
      <label for="upload_user_avatar"> <img src="/img/no-user.png" class="rounded-circle user cs avatar_user_uploaded"></label>
     
      @elseif(substr($user->avatar,0,4)=='http')
      <img src="{{ $user->avatar }}" class="rounded-circle user cs avatar_user_uploaded" id="myBtn-5">
      @else
      <img src="{{ pare_url_file($user->avatar,'user') }}" class="rounded-circle user cs avatar_user_uploaded" id="myBtn-5">
      @endif
      <img src="{{ asset('img/loading.gif')}}" class=" uploadavatar imguser" style="display:none;">
      
      </div>
      <form method="POST" enctype="multipart/form-data" id="form_upload_user_avatar">
         @csrf
         <input type="file" onchange="uploadUserAvatar(this,'form_upload_user_avatar')" accept="image/*"  name="upload_user_avatar" class="d-none" id="upload_user_avatar">
      </form>
      <!-- modal user image -->
      <div id="myModal-5" class="modal">
         <div class="modal-content setting animate__animated animate__zoomIn" >
            <li class="hed"><a href="javascript:;" >Thay ảnh của bạn</a></li>
            <li>
               <label for="change_user" class="text-blue change cs">Tải ảnh lên</label>
               <form method="POST" enctype="multipart/form-data" id="form_change_user_avatar">
                  @csrf
                  <input type="file" onchange="uploadUserAvatar(this,'form_change_user_avatar')" accept="image/*"  name="upload_user_avatar" class="d-none" id="change_user">
               </form>
            </li>
            <li><a href="javascript:;" class="text-red remove_current_photo">Gỡ ảnh hiện tại</a></li>
            <li class="cs" id="exit5"><a href="">Thoát</a></li>
         </div>
      </div>
      <div class="csa">
         <div class="clr csb">
            <span class="os" style="float:left">{{ $user->user }}</span>
            @if($user->user === \Auth::user()->user)
            <a href="">Chỉnh sửa trang cá nhân</a>
            <i class="fa fa-2x fa-sun-o" id="myBtn-2"></i> 
            <span class="fa-stack fa-lg cs" id="myBtn"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-plus fa-stack-1x"></i></span> 
            @else  
            <div class="list-follow">
            @if(!$followed)
            <button class="follow" onclick="follow('{{$user->id}}')">
                  <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$user->id}}" style="display:none">
                  <p class="text-follows{{$user->id}}">Theo dõi</p>
             </button>  
            @else
            <a href="{{ route('chat.show', $user->id) }}" class="message">Nhắn tin</a>
            <a class="unfollow follows{{$user->id}}"href="javascript:;"  onclick="follow('{{$user->id}}')">
            <i class="fa  fa-user-times"></i>
            <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$user->id}}" style="display:none;margin-top: -11px;">
         </a>
            @endif
</div>
            @endif
         </div>
         <!-- modal setting -->
         <div id="myModal-2" class="modal ">
            <div class="modal-content setting animate__animated animate__zoomIn" >
               <li><a href="">Đổi mật khẩu</a></li>
               <li><a href="">Thẻ tên</a></li>
               <li><a href="">Ứng dụng và trang web</a></li>
               <li><a href="">Thông báo</a></li>
               <li><a href="">Bảo mật và quyền riêng tư</a></li>
               <li><a href="">Hoạt động đăng nhập</a></li>
               <li><a href="">Email từ Instagram</a></li>
               <li><a href="">Báo cáo sự cố</a></li>
               <li><a href="">Đăng xuất</a></li>
               <li><a href="" id="exit">Hủy</a></li>
            </div>
         </div>
         <div class="clr csc">
            <p><b style="padding-right: 5px;">{{ count($post)}}</b> bài viết</p>
            <p class="cs" id="myBtn-6"><b style="padding-right: 5px;" class="follower">{{count($userFollow)}}</b> người theo dõi</p>
            <!-- modal setting -->
            <div id="myModal-6" class="modal">
               <div class="modal-content settings animate__animated animate__zoomIn" >
                  <li class="one">Người theo dõi <span class="float-right cs" id="exit6">&times;</span></li>
                 <div class="settingss">
                 @if(!count($userFollow)) 
                  <li class="k-none"><i class="fa fa-lg fa-user-plus"></i></li>
                  <li class="k-none two">Người theo dõi</li>
                  <li class="k-none three">Bạn sẽ thấy tất cả những người theo dõi bạn ở đây.</li>
                  @else
                  <!-- số người theo dõi mình -->
                  @foreach($userFollow as $list)  
                  <li class="clr user{{$list->user_id}}" style="height: 50px;">
                     <a href="{{ $list->users->user }}" class="zx position-relative ">
                     <img src="{{ pare_url_file($list->users->avatar,'user') }}" class="w-35 rounded-circle"> 
                     <b class="zz">{{ $list->users->user }}</b><br>
                     <b class="os">{{ $list->users->c_name }}</b>
                     </a>
                     @if($list->user_id!=\Auth::id())
                     @if(\App\Models\Follow::checkFollow(\Auth::id(),$list->user_id))
                      @if($user->id != \Auth::id())
                     <button class="followss zc{{$list->user_id}}" onclick="follows('{{$list->user_id}}')" ><cen class="cen{{$list->user_id}}">Đang theo dõi</cen>
                     <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}" style="display:none;margin-top: -11px;">
                     @else
                     <button class="followss zc{{$list->user_id}}" onclick="followss('{{$list->user_id}}')" ><cen class="cen{{$list->user_id}}">Đang theo dõi</cen>
                     <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}" style="display:none;margin-top: -11px;">
                     @endif
                  </button>
                     @else  
                     @if($user->id != \Auth::id())
                     <button class="follows zc{{$list->user_id}}" onclick="follows('{{$list->user_id}}')" ><cen class="cen{{$list->user_id}}">Theo dõi</cen>
                      <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->user_id}}">
                  </button> 
                     @else
                     <button class="follows zc{{$list->user_id}}" onclick="followss('{{$list->user_id}}')" ><cen class="cen{{$list->user_id}}">Theo dõi</cen>
                      <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->user_id}}">
                     </button> 
                     @endif
                     @endif
                     @endif
                  </li> 
                 
                  @endforeach
                  @endif
                  </div>
               </div>
            </div>
            <!--end modal-->
            <p class="cs" id="myBtn-7">Đang theo dõi <b class="count" style="float: none;">{{ count($areFollow) }}</b> người dùng</p>
            <!-- modal setting -->
            <div id="myModal-7" class="modal">
               <div class="modal-content settings animate__animated animate__zoomIn" >
                  <li class="one">Người theo dõi <span class="float-right cs" id="exit7">&times;</span></li>
                 <div class="list">
                 @if(!count($areFollow))
                  <li><i class="fa fa-lg fa-user-plus"></i></li>
                  <li class="two">Người đang theo dõi</li>
                  <li class="three">Bạn sẽ thấy tất cả những người bạn đang theo dõi ở đây.</li>
                  @else
                  <!-- đang theo dõi -->
                  @foreach($areFollow as $key=> $list)   
                  <li class="clr users{{$list->friends->id}}" style="height: 50px;">
                     <a href="{{ $list->friends->user }}" class="zx position-relative">
                     <img src="{{ pare_url_file($list->friends->avatar,'user') }}" class="w-35 rounded-circle"> 
                     <b class="zz">{{ $list->friends->user }}</b><br>
                     <b class="os">{{ $list->friends->c_name }}</b>
                     </a>
                     @if($list->friends->id!=\Auth::id()) 
                     @if(\App\Models\Follow::checkFollow(\Auth::id(),$list->friends->id))
                     @if($user->id != \Auth::id())
                     <button class="followss zc{{$list->friends->id}}" onclick="follows('{{$list->friends->id}}')" ><cen class="cen{{$list->friends->id}}">Đang theo dõi</cen>
                     <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}" style="display:none;margin-top: -11px;">
                     @else
                     <button class="followss zc{{$list->friends->id}}" onclick="followss('{{$list->friends->id}}')" ><cen class="cen{{$list->friends->id}}">Đang theo dõi</cen>
                     <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}" style="display:none;margin-top: -11px;">
                     @endif
                  </button>
                     @else 
                     @if($user->id != \Auth::id()) 
                     <button class="follows zc{{$list->friends->id}}" onclick="follows('{{$list->friends->id}}')" ><cen class="cen{{$list->friends->id}}">Theo dõi</cen>
                      <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->friends->id}}">
                  </button> 
                  @else
                  <button class="follows zc{{$list->friends->id}}" onclick="followss('{{$list->friends->id}}')" ><cen class="cen{{$list->friends->id}}">Theo dõi</cen>
                      <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->friends->id}}">
                  </button> 
                  @endif
                     @endif

                     @endif
                  </li> 
                  @endforeach
                  @endif
                 </div>
               </div>
            </div>
            <!--end modal-->
         </div>
         <b class="hem">{{ $user->c_name}}</b>  
      </div>
   </section>
   <div class="image d-none">
      <div class="title first">
         <b>Cancel</b>
         <p>New Post</p>
         <a href="javascript:;" class="next">Next <i class="fa fa-long-arrow-right"></i></a>
      </div>
      <div class="second d-none">
         <form action="{{ route('post.profile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title ">
               <a href="javascript:;" class="back"><i class="fa fa-long-arrow-left"></i> Back </a>
               <p>New Post</p>
               <button type="submit" class="submit">Share</button> 
               <img src="{{asset('img/loading.gif')}}"  class="w-30 nos" style="display:none">
            </div>
            <textarea name="p_content" class="textarea" placeholder="Write a caption... (max 2000 charaters)"></textarea>
      </div>
      <img id="image-post" src="{{ asset('img/heart-outline.png') }}" >
   </div>
   
   <div class="posts">
   <div class="d-gri csd">
   <button id="first" class="bt"><i class="fa fa-table"></i> BÀI VIẾT</button>
   <button id="second"><i class="fa fa-television"></i> IGTV</button>
   <button id="third"><i class="fa  fa-arrows-alt"></i> ĐÃ LƯU</button>
   <button id="fourst"><i class="fa fa-user"></i> ĐƯỢC GẮN THẺ</button> 
   </div> 
   <!-- modal upload profile and story -->
   <div id="myModal" class="modal"> 
   <div class="modal-content upload animate__animated animate__zoomIn ">
   <h4>Upload photo</h4>
   <div class="button">
   <div class="label">
   <label for="profiles" class="cs">Add to Profile</label>  
   <!--file-->
   <input type="file" accept="image/*" name="profiles" accept="image/*" id="profiles" class='d-none'>
   <!--file-->
   <p>or</p>
   </div>
   <div class="label label2">
   <label for="stories" class="cs">Add to Stories</label>
   <input type="file" accept="image/*" name="stories" id="stories"  accept="image/*" class="d-none"> 
   </div>
   </div>
   </div>
   </div> 
   </form>  
   <div class="post-image">
      @if(!count($post))
      <div class="clr">
         <br>
         <div class="hea">
            <b>Start capturing and sharing your moments.</b>
            <p>Get the app to share your first photo or video.</p>
            <br><br>
            <img src="{{ asset('img/appstore.png')}}" class="cs" style="height:40px;width:135px">
            <img src="{{ asset('img/chplay.png')}}" class="cs" style="height:40px;width:135px">
         </div>
      </div>
      <div><img src="{{ asset('img/everything.png')}}" class="float-left hed"></div>
      <br>
      @endif
      <div class="clr">
         @foreach($post as $key=> $val) 
         <div class="cs cse"  id="myBtnn{{$val->id}}">
            <div class="clr csf">
               <i class="fa fa-heart"></i> <p class="likes{{$val->id}}">{{ $val->p_favourite}}</p>
               <i class="fa fa-comment"></i> <p class="comment{{$val->id}}"> {{$val->p_comment }}</p>
            </div>
            <img src="{{ pare_url_file($val->p_image,'profile') }}"> 
         </div>
         <div id="myModall{{$val->id}}" class="modal hei">
            <div class="csg">
               <img src="{{ pare_url_file($val->p_image,'profile') }}" class="csq"> 
               <div class="cle">
                  <div class="heq">
                     <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
                     <div class="hee">
                        <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}} </a></b>
                           @if($val->user->id==$user->id)
                           @else
                           &#8729; <b>Đang theo dõi</b>
                           @endif
                        </p>
                     </div>
                     <i class="fa fa-ellipsis-h"></i>
                  </div>
                  <div class="her hdl{{$val->id}}" id="hell">
                     @if($val->p_content!='')
                     <div class="clr het">
                        <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
                        <div class="hep">
                           <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}}</a> </b> {{$val->p_content}}</p>
                        </div>
                        <i class="fa fa-ellipsis-h"></i> 
                        <div class="os heo">{{ $val->created_at->diffForHumans($now) }} 
                        </div>
                       
                     </div>  
                     @endif  
                     @foreach(\App\Models\Comment::where('c_post',$val->id)->get() as $cmt)  
                      
                     <div class="clr het">
                        <div class="hew"><a href="{{ route('get.home-page',$cmt->users->user)}}"><img src="{{ pare_url_file($cmt->users->avatar,'user') }}" class="{{ $cmt->c_user_id ==\Auth::id() ? 'avatar_user_uploaded' :''}}"></a> </div>
                        <div class="hep">
                           <p><b><a href="{{ route('get.home-page',$cmt->users->user)}}">{{$cmt->users->c_name}}</a> </b> {{$cmt->c_comment}}</p>
                        </div>
                        <i class="fa fa-ellipsis-h"></i>
                        <div class="os heo">12h</div>
                     </div> 
                     @endforeach
                  </div>
                  @php
                  $class=" fa-heart-o ";
                  if(\App\Models\Like::checkLove($val->id))
                  $class="fa-heart text-red";
                  @endphp
                  <div class="hey">
                     <i class="fa fa-15x heart{{$val->id}} {{ $class }}" onclick="likepost('{{$val->id}}')"></i> 
                     <i class="fa fa-15x fa-comment-o"></i> 
                     <i class="fa fa-15x fa-share-alt"></i>
                     <i class="fa fa-15x fa-bookmark-o float-right"></i><br>
                     <p class="f-6 view{{$val->id}}">{{$val->p_view}} lượt xem</p>
                     <p class="f-6 like{{$val->id}}">{{$val->p_favourite}} lượt thích</p> 
                     <p class="os">4 giờ trước</p>
                  </div>
                  <script> 
                     $('.heart{{$val->id}}').on('click',function(){
                        $(this).toggleClass('text-red');
                        $(this).toggleClass('fa-heart-o ');
                        $(this).toggleClass('fa-heart');
                     }) 
                  </script>
                  <div class="heu">
                     <form action="{{ route('comment.post')}}">
                        @csrf
                        <textarea class="textarea-{{$val->id}} textarea-comment{{$val->id}}" placeholder="Add a comment..."></textarea>
                        <input type="hidden" value="{{$val->id}}" class="post-comment{{$val->id}}">   
                        <button class="submit-{{$val->id}} submit-comment{{$val->id}} disabled">Đăng</button>
                        <img src="{{ asset('img/loading.gif')}}" class="w-30 load-comment" style="top: 10px;right: 15px;position: absolute;display:none;">
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <script>   
            $('body').on('click','#myBtnn{{$val->id}}',function(){
               var $div = $("#hell"); 
               $div.scrollTop($div[0].scrollHeight);
            })
            //không cho người dùng đăng khi chưa comment
            $('.textarea-{{$val->id}}').on('keyup',function(){
               if(!$('.textarea-{{$val->id}}').val())
               $('.submit-{{$val->id}}').addClass('disabled'); 
               else{ 
               $('.submit-{{$val->id}}').removeClass('disabled');
               }
            })
            //hiện modal bài viết 
          
            var thismodal{{$val->id}} = document.getElementById("myModall{{$val->id}}"); 
            var thisbtn{{$val->id}} = document.getElementById("myBtnn{{$val->id}}"); 
            var html=document.getElementsByTagName("html");
            thisbtn{{$val->id}}.onclick = function() {
            thismodal{{$val->id}}.style.display = "block";
            var post='{{$val->id}}';
            var URL ="{{ route('post.increview')}}";  
            $.get({
               url:URL,
               data:{post:post},
               success:function(e){  
                  $('.view{{$val->id}}').text(e.p_view+' lượt xem');
               }
            })
            }   
            //ẩn modal bài viết
            thismodal{{$val->id}}.onclick = function(event) {   
               if (event.target == thismodal{{$val->id}}) {    
               thismodal{{$val->id}}.style.display = "none";
              
               }
            }
           
            //comment
            $(".submit-comment{{$val->id}}").on('click',function(e){
            e.preventDefault();
            var URL= $(this).parents('form').attr('action');
            var c_comment=$('.textarea-comment{{$val->id}}').val();
            var c_post=$('.post-comment{{$val->id}}').val();
            var c_user_id='{{ \Auth::id()}}'; 
            $.get({ 
            url:URL,
            data:{c_comment:c_comment,c_post:c_post,c_user_id:c_user_id},
            beforeSend:function(){
               $('.load-comment').show();
               $('.submit-{{$val->id}}').hide();
            },
            complete:function(){
               $('.load-comment').hide();
               $('.submit-{{$val->id}}').show();
            }
            }).done(function(e){
               if(e.user.avatar){
                  var img ="/uploads/user/"+e.user.avatar;
               }
               else{
                  img ='/img/no-user.png';
               }
            $('.comment{{$val->id}}').text(e.count.p_comment);
            $(".hdl{{$val->id}}").append(`
            <div class="clr het">
            <div class="hew"><a href="/${e.user.user}"><img src="${img}" class="avatar_user_uploaded"></a> </div>
            <div class="hep"><p><b><a href="/${e.user.user}">${e.user.c_name}</a> </b>${c_comment}</p></div>
            <i class="fa fa-ellipsis-h"></i>
            <div class="os heo">2h</div>
            </div>
            `);
            $('.textarea-comment{{$val->id}}').val('');
            $('.submit-comment{{$val->id}}').addClass('disabled');

            var $div = $("#hell"); 
            $div.scrollTop($div[0].scrollHeight); 
            });
            })
            
            
         </script>     
         @endforeach 
      </div>
   </div>
   <div class="d-none post-video">
      @if(!count($video))
      <div class="hef">
         <span class="fa-stack fa-2x fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-video-camera fa-stack-1x"></i></span>
         <p>Upload a Video</p>
         <p>Videos must be between 1 and 60 minutes long.</p>
         <a href="{{ route('upload.video')}}">Upload</a>
      </div>
      @endif
   </div>
   <footer>
      <ul>
         <li class=" "><a href="">Giới thiệu</a></li>
         <li class=" "><a href="">Blog</a></li>
         <li class=" "><a href="">Việc làm</a></li>
         <li class=" "><a href="">Trợ giúp</a></li>
         <li class=" "><a href="">API</a></li>
         <li class=" "><a href="">Quyền riêng tư</a></li>
         <li class=" "><a href="">Điều khoản</a></li>
         <li class=" "><a href="">Tài khoản liên quan nhất</a></li>
         <li class=" "><a href="">Hashtag</a></li>
         <li class=" "><a href="">Vị trí</a></li>
         <li class=" "><a href="">Ngôn ngữ</a></li>
      </ul>
      <br> 
   </footer>
</body>
<p class="os" style="text-align:center">&copy; 2020 INSTAGRAM FROM FACEBOOK</p>
<br>
<script src="{{ asset('js/post.js') }}"></script> 
<script src="{{ asset('js/avatar.js') }}"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
<script type="text/javascript"> 
   //add to profile
      $('#profiles').on('change',function(ev){ 
        var reader=new FileReader(); 
        reader.onload=function(ev){
          $('#image-post').attr('src',ev.target.result).css('width','350px').css('height','350px').css('margin-bottom','50px'); 
        }
        reader.readAsDataURL(this.files[0]);   
            $('#myModal').hide();   
            $('.image').removeClass('d-none');
         
      });
   //add to stories
      $('#stories').on('change',function(ev){ 
        var reader=new FileReader(); 
        reader.onload=function(ev){
          $('#image-post').attr('src',ev.target.result).css('width','350px').css('height','350px').css('margin-bottom','50px'); 
        }
        reader.readAsDataURL(this.files[0]);   
            $('#myModal').hide();   
            $('.image').removeClass('d-none');
         
      });
   
   
</script>
<script>
   $('#first').on('click',function(e){
      e.preventDefault();
      $('.post-image').removeClass('d-none');
      $('.post-video').addClass('d-none');
   
      
      $(this).addClass('bt');
      $('#second').removeClass('bt');
   })
   $('#second').on('click',function(e){
      e.preventDefault();
      $('.post-image').addClass('d-none');
      $('.post-video').removeClass('d-none');
      
      $(this).addClass('bt');
      $('#first').removeClass('bt');
   })
</script>  
<script>
   $(function(){  
      $('.next').on('click',function(){
            $('.first').addClass('d-none');
            $('.second').removeClass('d-none');
       })
       $('.back').on('click',function(){
            $('.first').removeClass('d-none');
            $('.second').addClass('d-none');
       })
      $('.image b').css("cursor","pointer");
            $('.image b').on('click',function(){
            $('.image').addClass('d-none');
       })
       $('.submit').on('click',function(){
         $(this).hide();
         $('.nos').show();
      })
   })
   
   var modal6 = document.getElementById("myModal-6");
   var btn6 = document.getElementById("myBtn-6");
   var exit6 = document.getElementById("exit6");
   
   btn6.onclick = function() {
      modal6.style.display = "block";
   } 
   exit6.onclick = function() {
      modal6.style.display = "none";
   } 
   
   var modal7 = document.getElementById("myModal-7");
   var btn7 = document.getElementById("myBtn-7");
   var exit7 = document.getElementById("exit7");
   
   btn7.onclick = function() {
      modal7.style.display = "block";
   } 
   exit7.onclick = function() {
      modal7.style.display = "none";
   } 

  
   window.onclick = function(event) { 
      if (event.target == modal) {    
      modal.style.display = "none";
      }
   
      if (event.target == modal2) {    
      modal2.style.display = "none";
      }
    
      if (event.target == modal5) {    
      modal5.style.display = "none";
      }
      if (event.target == modal6) {    
      modal6.style.display = "none";
      }
      if (event.target == modal7) {    
      modal7.style.display = "none";
      }
      }
   var modal = document.getElementById("myModal"); 
   var btn = document.getElementById("myBtn"); 
   btn.onclick = function() {
   modal.style.display = "block";
   }  
   
   
   var modal2 = document.getElementById("myModal-2");
   var btn2 = document.getElementById("myBtn-2");
   var exit = document.getElementById("exit");
   
   btn2.onclick = function() {
      modal2.style.display = "block";
   } 
   exit.onclick = function(event) {
      event.preventDefault();    
      modal2.style.display = "none";
   }
   var modal5 = document.getElementById("myModal-5");
   
   
   
   
</script>
<script>
   $('body').on('click','#myBtn-5',function(){
      $('#myModal-5').show();
   })
   $('body').on('click','#exit5',function(){
      $('#myModal-5').hide();
   })
</script>
</body>
</html>