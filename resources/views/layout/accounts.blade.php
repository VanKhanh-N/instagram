@include('header') 
<link rel="stylesheet" href="{{asset('css/accounts.css')}}">
<body>
    <div class="content ">
    <div class="edit-form clr">
    <div class="edit-form__left">
        <ul class="cs">
            <li class="{{$title == 'Edit Profile' ? 'activate' : 'noactivate'}}"><a href="{{route('profile.edit')}}">{{__('translate.Edit Profile')}}</a></li>
            <li class="{{$title == 'Change Password' ? 'activate' : 'noactivate'}}"><a href="{{route('password.edit')}}">{{__('translate.Change Password')}}</a></li>
            <li><a>{{__('translate.Apps and Websites')}}</a></li>
            <li><a>{{__('translate.Email and SMS')}}</a></li>
            <li><a>{{__('translate.Notifications')}}</a></li>
            <li><a>{{__('translate.Manage Contacts')}}</a></li>
            <li><a>{{__('translate.Privacy and Security')}}</a></li>
            <li><a>{{__('translate.Login Activity')}}</a></li>
            <li><a>{{__('translate.Emails from Instagram')}}</a></li>
        </ul>
    </div>
    
    <div class="edit-form__right">
        @yield('content')
    </div><br>
    </div>
    </form>
    </div>   
</div><br>
 
    <footer style="width:80%;">
      <ul style="float:right">
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
<script src="{{ asset('js/modal.js') }}"></script>  
<script src="{{ asset('js/avatar.js') }}"></script>
</body>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>

    if(typeof TYPE_MESSAGE != "undefined"){
        switch (TYPE_MESSAGE){
            case 'success':
                toastr.success(MESSAGE)
                break;
            case 'error':
                toastr.error(MESSAGE)
                break;
        }
    }

    
</script>