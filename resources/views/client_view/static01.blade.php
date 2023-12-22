<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/static.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  


</head>
<body>
    @extends('client_view.frontend')
    @section('content')
    <div class="user-detail-container">
        <div class="row">
            <div class="account col-lg-3">
                <div class="account-user-heading">
                    <h3>MỤC LỤC</h3>
                </div>
                <ul class="option-user">
                    <li>
                        <a href="{{ route('category', ['category' => '1']) }}">Sneaker</a>
                    </li>
                    <li>
                        <a href="{{ route('category', ['category' => '2']) }}">Slide</a>
                    </li>
                    <li>
                        <a href="{{ route('category', ['category' => '3']) }}">Bag-Clothing</a>
                    </li>
                    <li>
                        <a href="{{ route('category', ['category' => '4']) }}">Accessories</a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}">Liên hệ</a>
                    </li>
                </ul>
    
            </div>
            <div class="user-detail-content col-lg-7">
                <div class="user-info">
                    <h3>Chính sách thanh toán</h3>
                </div>
                <div>
                    <p>BOSS GIÀY có các chính sách thanh toán <span class="bold-content">LINH HOẠT</span></p>
                    <ul>
                        <li>Chính sách thanh toán Tiền mặt tại shop</li>
                        <li>Chính sách thanh toán bằng chuyển khoản qua Ngân hàng</li>
                    </ul>
                    <span class="bold-content">Tên người thụ hưởng: PHẠM NHẬT ANH</span>
                    <p>SỐ TÀI KHOẢN: TECHCOMBAK: XXXXXXXX</p>
                    <p>Nội dung: Tên khách hàng + số điện thoại</p>
                </div>
                
            </div>
        </div>
    </div>
    @endsection
    
</body>
    
</html>