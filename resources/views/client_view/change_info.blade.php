<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/change_info.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  


</head>
<body>
    @extends('client_view.frontend')
    @section('content')
    <div class="user-detail-container">
        <div class="user-detail-heading">
            <h1>Tài khoản của bạn</h1>
        </div>
        <div class="row">
            <div class="account col-lg-3">
                <div class="account-user-heading">
                    <h3>TÀI KHOẢN</h3>
                </div>
                <ul class="option-user">
                    <li>
                        <a href="{{route('customer.info')}}">Thông tin tài khoản</a>
                    </li>
                    <li>
                        <a href="{{route('client.edit.customer', $customer->id)}}">Thay đổi thông tin</a>
                    </li>
                    <li>
                        <form action="{{route('customer.logout')}}" method="POST">
                            @csrf
                            <button type = "submit" style="border: none">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
    
            </div>
            <div class="user-detail-content col-lg-7">
                <div class="user-info">
                    <h3>THAY ĐỔI THÔNG TIN</h3>
                </div>
                <div class="change_info">
                    <div class="content">
                        <form action="{{ route('client.update.customer', $customer->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Họ và tên:</span>
                                    <input type="text" placeholder="Họ và tên" name="name" value="{{ $customer->name }}">
                                    @error('name')
                                    <p>{{$message}}</p>
                                    @enderror  
                                </div>
                                <div class="input-box">
                                    <span class="details">Email:</span>
                                    <input type="text" placeholder="Email" name="email" value="{{ $customer->email}}">
                                    @error('email')
                                    <p>{{$message}}</p>
                                    @enderror  
                                </div>
                                <div class="input-box">
                                    <span class="details">Mật khẩu</span>
                                    <input type="password" placeholder="Mật khẩu" name="password" value="">
                                    @error('password')
                                    <p>{{$message}}</p>
                                    @enderror  
                                </div>
                                <div class="input-box">
                                    <span class="details">Xác nhận mật khẩu:</span>
                                    <input type="" placeholder="Xác nhận mật khẩu" name="password_confirmation" value="">
                                    @error('password_confirmation')
                                    <p>{{$message}}</p>
                                    @enderror  
                                </div>
                                
                            </div>
                            <div class="button">
                                <input type="submit" value="Sửa Thông Tin">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    
</body>
    
</html>