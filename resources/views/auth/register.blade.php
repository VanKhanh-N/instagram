<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"> 
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    <section>
        <img src="{{ asset('img/logo.png') }}">
        <p class="dw">Đăng ký để xem ảnh và video từ bạn bè.</p>
        <a href="" class="faa"><i class="fa fa-facebook-square"></i> ĐĂNG NHẬP BẰNG FACEBOOK</a><br><br>
        <a href="" class="fas"><i class="fa fa-google"></i> ĐĂNG NHẬP BẰNG GOOGLE</a> 
        <div class="or" style="opacity: 0.5;" >
            <div class="bar"></div> 
            <div class="content">Hoặc</div>  
            <div class="bar"></div> 
        </div> 
        <form action="" method="POST">
        @csrf
            <div class="username">
                <input type="text" name="email" placeholder="Số di động hoặc email" >
             @if($errors->first('email'))    
                <span class="text-danger">{{$errors->first('email') }}</span>
                @endif
            </div>
            <div class="username">
                <input type="text"  name="c_name" placeholder="Tên đầy đủ" >
                 
                @if($errors->first('c_name'))    
                <span class="text-danger">{{$errors->first('c_name') }}</span>
                @endif      
            </div>
            <div class="username"> 
                <input type="text"  name="user" placeholder="Tên người dùng" >
                @if($errors->first('user'))    
                <span class="text-danger">{{$errors->first('user') }}</span>
                @endif 
               
            </div> 
            <div class="username">
                <input type="password"  name="password"  placeholder="Mật khẩu" > 
                @if($errors->first('password'))    
                <span class="text-danger">{{$errors->first('password') }}</span>
                @endif
            </div><br>
            <button type="submit">Đăng ký</button>
        </form><br>
        <p>Bằng cách đăng ký, bạn đồng ý với Điều khoản, Chính sách dữ liệu và Chính sách cookie của chúng tôi.</p>
        <div class="login">
        <span>Bạn có tải khoản</span>
        <a href="{{ route('get.login')}}">Đăng nhập</a>
    </div>
    </section>
    
</body>

<script src="https://use.fontawesome.com/452826394c.js"></script>
</html>