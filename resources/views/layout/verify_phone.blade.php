<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <style>
    .f-20{font-size:20px}
    body{  
    position:  absolute;
    top:20%;
    left:30%; 
    text-align: center;
    padding:45px;
    box-shadow: 0 3px 10px 0 rgba(0,0,0,.14);
}
inputt{
    border-top:none;
    border-left: none;
    border-right:none;
    width:2.25rem;
    outline:none;
    text-align:center
}
button{
    background-color:#ee4d2d;
    border:none;
    padding: 10px;
    width:50%;
    border-radius:5px;
    color:white
}
    </style>
</head>
<body>
    <p class="f-20">Vui Lòng Nhập Mã Xác Minh</p> 
    <p>Mã xác minh của bạn sẽ được gửi bằng tin nhắn đến điện thoại của bạn</p><br>  
    <form action="" method="post">
    @csrf
    <!-- <input maxlength="1">
    <input maxlength="1">
    <input maxlength="1">
    <input maxlength="1">
    <input maxlength="1">
    <input maxlength="1"> -->
    <input type="tel" name="" id="">
    <br><br>
    <button type="submit">Xác nhận</button>
    </form>
</body>
</html>