
<i class="fa fa-ellipsis-h" id="Btn{{$value}}"></i>
<!-- modal infomation -->
<div id="Modal{{$value}}" class="modal">
   <div class="modal-content setting animate__animated animate__zoomIn" >
      @if($val->user->id != \Auth::id())
      <li><a href="javascript:;" class="text-red">{{ __('translate.Report')}}</a></li>
      @endif
      <li><a href="{{route('post.view',$val->p_slug)}}" >{{ __('translate.Go to post')}}</a> </li>
      <li id="Btn1{{$value}}"><a href="javascript:;" >{{ __('translate.Share to')}} ...</a></li>
      <input type="text" value="{{route('post.view',$val->p_slug)}}" id="myInput" style="opacity:0;position:absolute">
      <li class="tooltip">
         <a onclick="myFunction()" onmouseout="outFunc()">
         <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
         {{ __('translate.Copy Link')}}
         </a>
      </li>
      <li class="cs" id="exits{{$value}}"><a href="javascript:;" >{{ __('translate.Cancel')}}</a></li>
   </div>
</div>
<!-- copy link -->
<script>
   function myFunction() {
   var copyText = document.getElementById("myInput");
   copyText.select();
   copyText.setSelectionRange(0, 99999);
   document.execCommand("copy");
   
   var tooltip = document.getElementById("myTooltip");
   tooltip.innerHTML = "Copied";
   }
   
   function outFunc() {
   var tooltip = document.getElementById("myTooltip");
   tooltip.innerHTML = "Copy to clipboard";
   }
</script>
<!-- modal share -->
<div id="Modal1{{$value}}" class="modal">
<div class="modal-content setting animate__animated animate__zoomIn" >
   <li><a href="javascript:;" class="text-red">{{ __('translate.Share to')}}</a></li>
   <li>
      <a href="javascript:;" >
         <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large">
      <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa fa-facebook" style="margin-top:0"></i>  {{ __('translate.Share to')}} Facebook </a>
      </div>
      </a>
   </li>
   <li><a class="twitter-sh are-button" href="https://twitter.com/intent/tweet"> <i class="fa fa-twitter" style="margin-top:0"></i> {{ __('translate.Share to')}} Twitter</a> </li>
   <li>
      <a href="javascript:;" >
         <div class="zalo-share-button" data-href="" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>
      </a>
   </li>
   <li class="cs" id="exits1{{$value}}"><a href="javascript:;" >{{ __('translate.Cancel')}}</a></li>
</div>

</div> 
                     <!-- modal -->
<script>
$(function(){
    //hiện modal info
          
    var modal{{$value}} = document.getElementById("Modal{{$value}}"); 
            var btn{{$value}} = document.getElementById("Btn{{$value}}");
            var exits{{$value}} = document.getElementById("exits{{$value}}"); 

            btn{{$value}}.onclick = function() {
            modal{{$value}}.style.display = "block";
            }   
            
            
   //hiện modal share
   var modal1{{$value}} = document.getElementById("Modal1{{$value}}"); 
            var btn1{{$value}} = document.getElementById("Btn1{{$value}}");
            var exits1{{$value}} = document.getElementById("exits1{{$value}}"); 
            btn1{{$value}}.onclick = function() {
               modal{{$value}}.style.display = "none";
               modal1{{$value}}.style.display = "block";
               $('meta').remove();
               $('head').preend(`
                  <meta name="url" property="og:url" content="{{  route('post.view',$val->p_slug) }}">
                  <meta name="type" property="og:type" content="website" />
                  <meta name="description" property="og:description" content="{{$val->p_content}}">
                  <meta name="image" property="og:image" content="{{$val->p_image}}">
                  <meta property="twitter:card" content="summary_large_image">
                  <meta name="description" property="twitter:description" content="{{$val->p_content}}">
                  <meta name="image" property="twitter:image" content="{{$val->p_image}}">
                  <meta name="url" property="twitter:domain" content="{{   route('post.view',$val->p_slug) }}">

                  <meta property="zalo:card" content="summary_large_image">
                  <meta name="description" property="zalo:description" content="{{$val->p_content}}">
                  <meta name="image" property="zalo:image" content="{{$val->p_image}}">
                  <meta name="url" property="zalo:domain" content="{{   route('post.view',$val->p_slug) }}">
`);

            }   
               window.onclick = function(event) {   
               if (event.target == modal1{{$value}}) {    
               modal1{{$value}}.style.display = "none";
               }
               if (event.target == modal{{$value}}) {    
               modal{{$value}}.style.display = "none";
               }
            }
               //ẩn modal1 share

            exits1{{$value}}.onclick = function(event) {   
               modal1{{$value}}.style.display = "none";
            }
            //ẩn modal info
            exits{{$value}}.onclick = function(event) {   
               modal{{$value}}.style.display = "none";
            }
})
</script>   
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0&appId=286256932921835&autoLogAppEvents=1" nonce="q6VBxwqq"></script>  
             
<script src="https://sp.zalo.me/plugins/sdk.js"></script>
