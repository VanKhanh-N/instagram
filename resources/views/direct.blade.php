
@include('header') 
 
<!-- <div id="id01" class="w3-modal d-none"> -->
<div id="id01" class="w3-modal d-none">
    <div class="w3-modal-content animate__flipInX d-flex po"> 
      <div class="clr pp">
         <span class="cs closemodal">&times;</span>
         <p>{{ __('translate.New Message')}}</p>
         <button class="disabled nexts">{{ __('translate.Next')}}</button>
      </div>

      <div class="pi"> 
         <form >
         @csrf
         <p class="pr">{{ __('translate.To')}}:</p>
        <div class="pe">
        <div class="d-flex pw">
             
         </div>
        </div>
         <input type="text" name="key" placeholder="{{ __('translate.Search')}}..." id="search" autocomplete="off">
         </form>
      </div>

      <div class="pu "> 
         <b class="pq">{{ __('translate.Suggested')}}</b>
         @foreach($chat as $key=>$list)
         <div class="clr py cs py{{$list->id}}"> 
            <img src="{{ pare_url_file($list->friends->avatar,'user')}}" class="rounded-circle">
            <div> 
               <b>{{ $list->friends->user}}</b><br>
               <p class="os">{{$list->friends->c_name}}</p> 
            </div>
            <button class="cs hihi{{$key}}"><i class="fa fa-lg fa-check haha{{$key}}"></i></button>
         </div>

         <script> 
        

            $('.py{{$list->id}}').on('click',function(){
               if($('.hihi{{$key}}').hasClass('background-blue')){
                  $('.hihi{{$key}}').removeClass('background-blue'); 
                  $('.pt{{$key}}').remove();
               }else{  
               $('.hihi{{$key}}').addClass('background-blue'); 
               $('.pw').append(` 
               <div class="pt pt{{$key}}" id="pt{{$key}}">
                  <a href="javascript:;">{{$list->friends->user}} <span class="close{{$key}}">&times;</span></a> 
               </div> 
               `);
               }
            });  
            $('body').on('click','.close{{$key}}',function(){
            $('.pt{{$key}}').remove();
            $('.hihi{{$key}}').removeClass('background-blue'); 
            if($('.pu button').hasClass("background-blue")){
            $('.nexts').removeClass('disabled');
             }else{
            $('.nexts').addClass('disabled');
             }  
         })  
         </script> 

         
         @endforeach 
    </div>
  </div>
  </div>



<div class="messages  d-block">
<div class="left d-inline-block" style="height: 100%;width:35%; ">
   <div class="top-left  position-relative">
      <p>{{ \Auth::user()->c_name}}</p>
      <img src="{{ asset('img/direct-message.png') }}" class="openmodal cs">
   </div>
   <div class="bottom-left position-relative">
      <ul id="app">
    
         @foreach($chat as $list)
         @php
            $userr =$list->friends;
            if( $list->friends->id == \Auth::id())
            $userr =$list->users;
         @endphp
         <li class="clr" >
            <a href="{{ route('chat.show', $userr->id) }}">
               <img src="{{ pare_url_file($userr->avatar,'user') }}">
               <p>{{ $userr->c_name}}</p>
               <br>
               <onlineuser v-bind:friend="{{  $userr }}" v-bind:onlineusers="onlineUsers"></onlineuser>
            </a>
         </li>
         @endforeach  
      </ul>
   </div>
</div>
<div class="rights d-inline-block" style="height: 100%;width:65%;background-color: white; ">
    <div class="d-flex we">
        <img src="{{asset('img/direct-content.png')}}">
        <p>{{ __('translate.Your Messages')}}</p> 
        <p class="os">{{ __('translate.Send private photos and messages to a friend or group.')}}</p>
        <button class="openmodal">{{ __('translate.Send Message')}}</button>
    </div>
</div>
</section>

<script>
   $(function(){
      $('body').on('click','.pu button',function(){
      if($('.pu button').hasClass("background-blue")){
         $('.nexts').removeClass('disabled');
      }else{
         $('.nexts').addClass('disabled');
      }
      })
       $(".openmodal").on('click',function(){
         $('#id01').removeClass('d-none');
       })
       $(".closemodal").on('click',function(){
         $('#id01').addClass('d-none');
       })
      var modal= document.getElementById("id01");
       window.onclick=function(event){ 
          if(event.target==modal)
         $('#id01').addClass('d-none'); 
       } 

      $('#search').on('keyup',function(){
         var val =$(this).val();  
         var URL="{{route('searchmess')}}";   
           $.get({
              url:URL,
              data:{value:val},
              success:function(data){ 
               $(".pu").empty(); 
              $(".pu").prepend(data);  
           }
           }) 
      })
   })
</script>
</body>  
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
</html>