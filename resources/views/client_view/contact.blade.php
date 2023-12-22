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
        <div class="user-detail-heading">
            <h1>LIÊN HỆ</h1>
        </div>
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
                        <a href="#">Liên hệ</a>
                    </li>
                </ul>
    
            </div>
            <div class="user-detail-content col-lg-7">
                <div class="user-info">
                    <h3>THÔNG TIN LIÊN HỆ</h3>
                </div>
                <div>
                    <p><span class="bold-content">Email</span>: nhom7CNPM@email.com</p>
                    <p><span class="bold-content">Số điện thoại</span>: 0865380226</p>
                    <p><span class="bold-content">Địa chỉ</span>: 175 Tây sơn Đống Đa Hà Nội</p>
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.645492692938!2d105.82292677596227!3d21.006843080636923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad744eb9a567%3A0x86ebcd89ee0bda7b!2zMTc1IFAuIFTDonkgU8ahbiwgVHJ1bmcgTGnhu4d0LCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1695132994824!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endsection
    
</body>
    
</html>