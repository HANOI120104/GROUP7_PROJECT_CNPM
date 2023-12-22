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
    <link rel="stylesheet" href="{{ asset('css/product_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client_product_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<body>
    @extends('client_view.frontend')
    @section('content')
    <main>
        <div class="collection-page">
            <div class="main-content">
                <div class="link-header-categories">
                    <div class="link-page">
                        <ol class="breadcrumb-arrows">
                            <li>
                                <a href="">
                                    <span>Trang chủ</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span>Danh mục</span>
                                </a>
                            </li>
                            <li>
                                <span>{{$product->ProductName}}</span>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- main -->
                <div class="product-detail-container">
                    <div class="detail-container row">
                        <div class="list-img col-md-1">
                            <div class="img-mini">
                                @foreach($images as $img)
                                <a href="" class="mini-image-link">
                                    <img src="{{asset($img)}}" alt="">
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="img-main col-md-5 col-sm-12 col-12">
                            <div class="product-image-detail">
                                <img src="{{asset($images[0])}}" alt="" class="main-image">
                            </div>
                        </div>
                        <div class="product-detail-content col-md-5 col-ms-12 col-12">
                            <div class="product-detail-ct">
                                <div class="product-titile">
                                    <h1>{{$product->ProductName}}</h1>
                                </div>
                                <div class="product-price">
                                    <p>{{$product->Price}}</span></p>
                                </div>
                            </div>
                            <div class="info-product">
                                <div class="information-pro">
                                    <p>{{$product->ProductDescription}}</p>
                                </div>
                            </div>
                            <div class="add-item-form">
                                <form action="{{route('add.to.cart')}}" method = "POST">
                                    @csrf
                                    <div class="add-size-form">
                                        @foreach($sizes as $size)
                                        <div class="size-input">
                                            <input type="radio" class="btn-check" name="size" id="size{{$size->id}}" value = "{{$size->SizeName}}" {{ $loop->first ? 'checked' : '' }}>
                                            <label class="btn btn-outline-secondary" for="size{{$size->id}}">{{$size->SizeName}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                        
                                    <div class="edit-amount">
                                        <input type="button" name="" id="drop" value="-" onclick="decrease()">
                                        <input type="number" id="input-amount" value="1" name = "quantity" readonly>
                                        <input type="button" name="" id="add" value="+" onclick="increase()">
                                    </div>
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="ProductName" value="{{ $product->ProductName }}">
                                    <input type="hidden" name="Price" value="{{ $product->Price }}">
                                    <input type="hidden" name="URL" value="{{$images[0]}}">
                                    <div class="link-to-shop">
                                        <button class="link-check">Thêm vào giỏ</button>
                                        <div class="spacing"></div>
                                        <button class="link-cart" formaction="{{ route('buy.now') }}">Mua ngay</button>

                                    </div>
            
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="section-collection">
                    <div class="collection-1">
                        <div class="container-1">
                            <div class="wrapper-heading-home">
                                <h2>
                                    <a href="">Sản phẩm liên quan</a>
                                </h2>
                                <div class="view-all" >
                                    <a href="">More</a>
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
            </div>

        </div>
    </main>
    @endsection
    <script>
        function increase() {
            var input = document.getElementById("input-amount");
            input.value = parseInt(input.value) + 1;
        }

        function decrease() {
            var input = document.getElementById("input-amount");
            var currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.mini-image-link').on('click', function (e) {
            e.preventDefault();
            var imageUrl = $(this).find('img').attr('src');
            $('.main-image').attr('src', imageUrl);
        });
    });
</script>
<script>
        // Sử dụng sự kiện DOMContentLoaded để đảm bảo mã JavaScript chỉ được thực thi khi DOM đã tải
        document.addEventListener("DOMContentLoaded", function() {
            let priceElements = document.querySelectorAll(".product-price p");

            // Lặp qua tất cả các phần tử chứa giá tiền và chuyển đổi sang định dạng tiền tệ
            priceElements.forEach(function(element) {
                let price = parseFloat(element.innerText.replace("đ", "").replace(/\./g, ""));
                let formattedPrice = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
                element.innerText = formattedPrice;
            });
        });
    </script>

</html>