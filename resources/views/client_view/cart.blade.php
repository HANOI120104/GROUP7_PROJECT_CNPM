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
    <link rel="stylesheet" href="{{ asset('css/product_card_cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<body>
    @extends('client_view.frontend')
    @section('content')
    <div class="cart-container">
        <div class="link-header-categories">
            <div class="link-page">
                <ol class="breadcrumb-arrows">
                    <li>
                        <a href="">
                            <span>Trang chủ</span>
                        </a>
                    </li>
                    <li>
                        <span>Giỏ hàng({{ Cart::getTotalQuantity() }})</span>
                    </li>
                </ol>
            </div>
        </div>
        <div class="cart-content">
            <div class="heading-cart-container row">
                <div class="cart-heading col-lg-7">
                    <h1>GIỎ HÀNG CỦA BẠN</h1>
                </div>
                <div class="col-lg-3">

                </div>
            </div>
            <div class="cart-main row">
                <div class="product-cart-list col-lg-7 col-md-7 col-ms-7">
                    <div class="cart-atler">
                        <p>Bạn đang có <span>{{ Cart::getTotalQuantity() }}</span> sản phẩm</p>
                    </div>
                    <div class="product-cart-detail">
                        <table>
                        @foreach($cartItems as $item)
                            <tr>
                                <td class="img-td"><img src="{{ asset($item->attributes->url) }}" alt=""></td>
                                <td class="name-td">{{ $item->name }}<br>{{ $item->attributes->size }}</td>
                                <td class="btn-td">
                                    <div class="btn-td-main">
                                    <form action="{{ route('change.quantity') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <button type="submit" name="action" value="drop">-</button>
                                        <input type="text" class="input-amount" value="{{ $item->quantity }}" readonly>
                                        <button type="submit" name="action" value="add">+</button>
                                    </form>
                                    </div>
                                </td>
                                <td class="price-td">{{ number_format($item->price) }}<span>đ</span></td>
                                <td class="total-td">
                                    Thành tiền: <br>
                                    <span>{{ number_format($item->price * $item->quantity) }}</span>đ
                                </td>
                                <td class="delete-td">
                                    <form action="{{ route('cart.remove', ['id' => $item->id]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                    <div class="cart-note row">
                        <div class="col-lg-6 col-md-12">
                            <p>Chính sách Đổi/Trả</p>
                            <ul>
                                <li>Sản phẩm được hỗ trợ đổi size trong vòng 3 ngày</li>
                                <li>Sản phẩm còn đủ tem mác, chưa qua sử dụng.</li>
                                <li>Đối với khách hàng ở tỉnh ngoài HCM sản phẩm được đổi size trong 7 ngày kể từ ngày nhận</li>
                                <li>Liên hệ: 0909956706 để được hỗ trợ nhanh nhất ạ</li>
                                <li>PAGE: BOSS GIÀY</li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="cart-total col-lg-3 col-md-7 col-ms-7">

                        <div class="order-info">
                            <h5>Thông tin đơn hàng</h5>
                        </div>
                        <div class="total-order">
                            <p>Tổng tiền:</p>
                            <p>{{number_format(Cart::getTotal())}}đ</p>
                        </div>
                        <div class="checkout-btn">
                        @if(!Cart::isEmpty())
                            <p>Bạn có thể nhập mã giảm giá ở trong thanh toán</p>
                            <a href="{{ route('show.thanhtoan') }}" class="btn btn-dark">THANH TOÁN</a>
                        @else
                            <p class="text text-danger">Giỏ hàng của bạn trống</p>
                        @endif

                </div>
            </div>
        </div>
    </div>
    <div class="section-collection">
        <div class="collection-1">
            <div class="container-1">
                <div class="wrapper-heading-home">
                    <h2>
                        <a href="">Có thể bạn sẽ thích</a>
                    </h2>
                    <div class="view-all" >
                        <a href="">Xem thêm</a>
                    </div>
                </div>
                <div class="row product-list">
                @foreach ($productsWithImages as $item)
                        <div class="col-md-3 col-sm-6 col-xs-6 product">
                            <div class="product_block">
                                <div class="product-img">
                                    <a href="{{ route('detail.product', ['id' => $item['otherProduct']->id]) }}">
                                        <picture class="pt1"><img
                                                src="{{ asset($item['image1']) }}"
                                                alt=""></picture>
                                        <picture class="pt2"><img
                                                src="{{ asset($item['image2']) }}"
                                                alt=""></picture>
                                    </a>
                                    <div class="button-add">
                                    <form id="product-form" action="{{ route('add.to.cart') }}" method="POST" enctype="multipart.form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item['otherProduct']->id }}">
                                                        <input type="hidden" name="ProductName" value="{{ $item['otherProduct']->ProductName }}">
                                                        <input type="hidden" name="Price" value="{{ $item['otherProduct']->Price }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <input type="hidden" name="size" value="{{ $item['size'] }}">
                                                        <input type="hidden" name="URL" value="{{ asset($item['image1']) }}">
                                                        <button class="tobuy" formaction="{{ route('buy.now') }}">Buy</button>
                                                        <button type="submit" class="tocart">Add to cart</button>
                                            </form>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="box-pro-details">
                                        <h3 class="pro-name">
                                            <a href="{{ route('detail.product', ['id' => $item['otherProduct']->id]) }}">
                                                {{ $item['otherProduct']->ProductName }}
                                            </a>
                                        </h3>
                                        <div class="pro-price">
                                            <p>{{ $item['otherProduct']->Price }}đ</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    @endsection
</body>

</html>