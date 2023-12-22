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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>
<body>
    @extends('client_view.frontend')
    @section('content')
    <div class="section-collection">
        <div class="collection-1">
            <div class="container-1">
                <div class="wrapper-heading-home">
                    <h2>
                        <a href="#">Tìm kiếm</a>
                    </h2>
                    <div class="view-all" >
                        <span>Có {{$count}} sản phẩm cho tìm kiếm</span>
                    </div>
                    <div class="result-search-sr">
                        <p>Kết quả tìm kiếm cho '<span>{{$keyword}}</span>'.</p>
                    </div>
                </div>
                @if($count > 0)
                <div class="row product-list">
                    
                @foreach ($productsWithImages as $item)
                        <div class="col-md-3 col-sm-6 col-xs-6 product">
                            <div class="product_block">
                                <div class="product-img">
                                    <a href="{{ route('detail.product', ['id' => $item['product']->id]) }}">
                                        <picture class="pt1"><img
                                                src="{{ $item['image1'] }}"
                                                alt=""></picture>
                                        <picture class="pt2"><img
                                                src="{{ $item['image2'] }}"
                                                alt=""></picture>
                                    </a>
                                    <div class="button-add">
                                    <form id="product-form" action="{{ route('add.to.cart') }}" method="POST" enctype="multipart.form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item['product']->id }}">
                                                        <input type="hidden" name="ProductName" value="{{ $item['product']->ProductName }}">
                                                        <input type="hidden" name="Price" value="{{ $item['product']->Price }}">
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
                                            <a href="{{ route('detail.product', ['id' => $item['product']->id]) }}">
                                                {{ $item['product']->ProductName }}
                                            </a>
                                        </h3>
                                        <div class="pro-price">
                                            <p>{{ $item['product']->Price }}đ</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <h2 style="color: red">Không tìm thấy sản phẩm nào</h2>
                @endif
            </div>
        </div>

    </div>
    @endsection
</body>
</html>