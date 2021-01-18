<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}"> 
</head>
<body>
    <section>
        <div class="img">
            <img src="{{asset('img/lock.png') }}">
        </div>
        <b>Bạn gặp sự cố khi đăng nhập?</b>
        <p>Nhập email, số điện thoại hoặc tên người dùng của bạn và chúng tôi sẽ gửi cho bạn một liên kết để truy cập lại vào tài khoản.</p>
      
        <form action="" method="POST">
        @csrf
            <div class="username">
                <input type="text" name="email" placeholder="Số di động hoặc email" >
                @if($errors->first('email'))    
                <span class="text-danger">{{$errors->first('email') }}</span>
                @endif
            </div>
           <br>
            <button type="submit">Gửi liên kết đăng nhập</button>
        </form><br>
        <div class="or" >
            <div class="bar"></div> 
            <div class="content">Hoặc</div>  
            <div class="bar"></div> 
        </div><br><br>
        <a href="{{ route('get.register') }}">Tạo tài khoản mới</a> 
        <div class="end-login">
           <a href="{{ route('get.login') }}"> Quay lại trang đăng nhập</a>
        </div> </section>
   
</body>

<script src="https://use.fontawesome.com/452826394c.js"></script>
</html>