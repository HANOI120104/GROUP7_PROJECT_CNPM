<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    @extends('client_view.frontend')
    @section('content') 
    <div class="layer-account">
        <div class="container-login">
            <div class="container-login-content row">
                <div class="heading-login col-md-6 col-ms-12 col-12">
                    <div class="header-page">
                        <h1>Tạo tài khoản</h1>
                    </div>
                </div>
                <div class="form-login col-md-6 col-ms-12 col-12">
                    <div class="form-container">
                        <form action="{{route('customer.register')}}" method = "POST">
                            @csrf
                            @error('name')
                            <div class="notify-register">
                                <p>{{$message}}</p>
                            </div>
                            @enderror
                            <div class="input-name">
                                <input type="text" name="name" id="name"  placeholder="Họ và tên">
                            </div>
                            @error('email')
                            <div class="notify-register">
                                <p>{{$message}}</p>
                            </div>
                            @enderror
                            <div class="input-email">
                                <input type="email" placeholder="Email" name="email" id="email" >
                            </div>
                            @error('password')
                            <div class="notify-register">
                                <p>{{$message}}</p>
                            </div>
                            @enderror
                            <div class="input-pass">
                                <input type="password" placeholder="Mật khẩu" name="password" id="password" >
                            </div>
                            @error('password_confirmation')
                            <div class="notify-register">
                                <p>{{$message}}</p>
                            </div>
                            @enderror
                            <div class="input-pass">
                                <input type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation" id="password_confirmation" >
                            </div>
                            <div class="button-submit">
                                <div class="btoon-sub">
                                    <button type="submit">Đăng ký</button>
                                </div>
                                <div class="other-sub">
                                    <span>Bạn đã có tài khoản</span>
                                    <br>
                                    <a href="{{route('customer.info')}}">Đăng nhập</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>