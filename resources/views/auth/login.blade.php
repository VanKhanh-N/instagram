<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> 
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> 
    <title>Đăng nhập</title>
    @if(session('toastr'))
        <script>    
            var TYPE_MESSAGE="{{session('toastr.type') }}";
            var MESSAGE ="{{session('toastr.messages') }}";
        
        </script>
    @endif
</head>
<body>
    <div class="login-left">
        <img src="{{ asset('img/login.png') }}" >
    </div>
    <div class="login-right">
    <div class="login ">
        <div class="logo"><img src="{{ asset('img/logo.png') }}" ></div>
        <form action="" method="POST">
        @csrf
            <div class="username">
                <input type="email" class="username" id="username" name="email" placeholder="Số điện thoại, tên người dùng hoặc email" >
                @if($errors->first('email'))    
                <span class="text-danger">{{$errors->first('email') }}</span>
                @endif
               
            </div><br>
            <div class="username">
                <input type="password" class="password" id="password" name="password" placeholder="Mật khẩu" > 
                @if($errors->first('password'))    
                <span class="text-danger">{{$errors->first('password') }}</span>
                @endif
            </div> 
            <button type="submit">Đăng nhập</button>
        </form><br>
        <div class="or" >
            <div class="bar"></div> 
            <div class="content">Hoặc</div>  
            <div class="bar"></div> 
        </div><br><br>
        <div class="fb-login">
            <a href="{{ url('/auth/redirect/facebook') }}"><i class="fa fa-lg fa-facebook-square"></i> Đăng nhập bằng facebook</a>
        </div>
        <div class="google-login">
            <a href="{{ url('/auth/redirect/google') }}"><i class="fa fa-lg fa-google-plus-square"></i> Đăng nhập bằng Google</a>
        </div> 
        <div class="forget-password">
            <a href="{{ route('get.forgot-password') }}">Quên mật khẩu</a>
        </div>
    </div>
</div>
        
    <div class="register">
        <span>Bạn chưa có tải khoản</span>
        <a href="{{ route('get.register') }}">Đăng ký</a>
    </div>
    <!-- <footer>
        <a href="">GIỚI THIỆU</a>
        <a href="">TRỢ GIÚP</a>
        <a href="">BÁO CHÍ</a>
        <a href="">API</a>
        <a href="">VIỆC LÀM</a>
        <a href="">QUYỀN RIÊNG TƯ</a>
        <a href="">ĐIỀU KHOẢN</a>
        <a href="">VỊ TRÍ</a>
        <a href="">TÀI KHOẢN LIÊN QUAN NHẤT</a>
        <a href="">HASHTAG</a>
        <a href="">NGÔN NGỮ</a>
        <p>&copy;  2020 INSTAGRAM FROM FACEBOOK</p>
    </footer> -->
    <script src="https://use.fontawesome.com/452826394c.js"></script>
    <script>
        $(function(){
            $("#username").on("keyup",function(){
                var x = document.getElementById("username");
                if(x.value.length>0){
                $(".label-user").css({"font-size":"10px","transform":"translateY(-13px)"});
                }
                else{
                $(".label-user").css({"font-size":"12px","transform":"translateY(0px)"});
                }
            })
            $("#password").on("keyup",function(){
                var x = document.getElementById("password");
                if(x.value.length>0){
                $(".label-password").css({"font-size":"10px","transform":"translateY(-13px)"});
                }
                else{
                $(".label-password").css({"font-size":"12px","transform":"translateY(0px)"});
                }
            }) 
        })
    
    </script>
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
</html>