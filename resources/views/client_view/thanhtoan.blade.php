<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/thanhtoan.css') }}">
</head>

<body>
    @extends('client_view.frontend')
    @section('content')
    <div class="pm-container row">
        <div class="info-ship-container col-lg-5 col-md-5 col-ms-12">
            <div class="pm-heading">
                <h3>BOSS GIÀY</h3>
            </div>
            <div class="linktopm">
                <ul>
                    <li><a href="">Giỏ hàng</a></li>
                    <li><a href="">Thông tin giao hàng</a></li>
                    
                </ul>
            </div>
            <div class="info-ship-section">
                <h4>Thông tin giao hàng</h4>
            </div>
            <form action="{{route('thanhtoan')}}" method = "POST">
                @csrf

                <div class="input-name">
                    <label for="nameCus">Họ và tên</label>
                    <input type="text" name="fullname" value="{{$customer->name}}">
                    @error('fullname')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-email">
                    <label for="emailCus">Email</label>
                    <input type="text" name="email" value="{{$customer->email}}">
                    @error('email')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-phone">
                    <label for="phoneCus">Số điện thoại</label>
                    <input type="text" name="phone">
                    @error('phone')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="method-ship">
                    
                        <label for="addr-ship">Địa chỉ giao hàng</label>
                        <input type="text" name="address">
                        @error('address')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    
 
                </div>
                <input type="hidden" name="Total" value = "{{Cart::getTotal()}}">
                <input type="hidden" name="customer_id" value = "{{$customer->id}}">
            <div class="step-foot-cart">
                <a class="tocart" href="{{route('show.cart')}}">Giỏ hàng</a>
                <button>
                    Thanh toán
                </button>
            </div>
            </form>
            
        </div>
        <div class="view-cart-container col-lg-4 col-md-4 col-ms-12">
            <div class="viewtocart">
                <table>
                @foreach($cartItems as $item)
                    <tr>
                        <td class="pro-img-cart">
                            <div >
                            <img src="{{ asset($item->attributes->url) }}" alt="">     
                            </div>
                        </td>
                        <td class="pro-info-cart">
                            <div>
                                <span style="font-weight: 500;">{{ $item->name }}</span>
                                <br>
                                <span style="margin-right: 20px;">{{ $item->attributes->size }}</span>
                                <span>SL: {{ $item->quantity }}</span>
                            </div>
                        </td>
                        <td class="pro-price-cart">
                            <div>
                                <span>{{ number_format($item->price) }}đ</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </table>

            </div>
            <div class="voucher">
                <div class="voucher-content">
                    <label for="mgg">Mã giảm giá</label>
                    <input type="text" name="mgg">
                </div>
                <button>Sử dụng</button>
            </div>
            <div class="after-total">
                <h3>Tổng cộng</h3>
                <p>VND <span>{{number_format(Cart::getTotal())}}đ</span></p>
            </div>
        </div>
    </div>
    @endsection
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>

</html>