<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Trang chủ</title>
</head>
<body style="background-color: #e9ecefe8;">
    {{View::make('Navbar')}}
    <!-- @if(Session::has('email'))
    <h1>{{Session::get('email')}}</h1>
    @endif -->
    <!-- <a href="/logout">Logout</a> -->
    <div class="container">
       <div class="header_container">
           <div class="text_home">
            <p>Hệ: Đại học CQ  NH: 2020-2021  HK: 1</p>
           </div>
           <div class="info_home">
            <p>Trang thông tin | Tài khoản:@if(Session::has('email'))
                {{Session::get('email')}}
                <a href="/logout">Đăng xuất</a>
                @endif
            </p>
           </div>
       </div>
       <div class="tinhnang">
            <div class="trangcanhan">
                <div class="trangcanhan_img">
                <img src="{{asset('img/lambaithi.png')}}">
                </div>
                <a href="home/trangcanhan"><button type="button" class="btn btn-primary">Trang cá nhân</button></a>
            </div>
            <div class="trangcanhan">
                <div class="trangcanhan_img">
                <img id="quiz_test" src="{{asset('img/pro5.png')}}">
                </div>
                <a href="home/thuchanh"><button type="button" class="btn btn-primary">Làm bài thi</button></a>
            </div>
            <div class="trangcanhan">
                <div class="trangcanhan_img">
                <img src="{{asset('img/lambaithi.png')}}">
                </div>
                <a href="home/trangcanhan"><button type="button" class="btn btn-primary">Trang cá nhân</button></a>
            </div>
       </div>
    </div>
    <p></p>
    {{View::make('footer')}}
</body>
</html>