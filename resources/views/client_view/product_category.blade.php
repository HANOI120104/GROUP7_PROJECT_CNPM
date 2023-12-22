<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breadcrumb-shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product_card_category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_category.css') }}">
    <!-- <link rel="stylesheet" href="homepage.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


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

                                <span>{{$category->CatName}}</span>

                            </li>
                        </ol>
                    </div>
                </div>
                <div class="filter-section-categories">
                    <div class="category-section">
                        <div class="filter-section">
                            <div class="wrap-filter">
                                <div class="box_sidebar">
                                    <div class="brand-menu">
                                        <div class="category">
                                            <nav class="category-content">
                                                <div class="category-heading">
                                                    <span>Danh mục sản phẩm</span>
                                                </div>
                                                <ul class="tree-menu" style="margin: 0; padding: 0;">
                                                    <li>
                                                        <a
                                                            href="{{ route('category', ['category' => '1']) }}">Sneaker</a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('category', ['category' => '2']) }}">Slide/Sandal</a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('category', ['category' => '3']) }}">Bag/Clothing</a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('category', ['category' => '4']) }}">Accessories</a>
                                                    </li>
                                                    <li>
                                                        <a href="">Liên hệ</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <form id="filter-form">

                                        <div class="layered">
                                            <div class="block-content">
                                                <div class="filter-heading">
                                                    
                                                    <div class="dropdown-content">
                                                        <div class="group-filter dropdown">
                                                            <div class="layered-sub">
                                                                <button class="btn btn-secondary dropdown-toggle brand-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    THƯƠNG HIỆU
                                                                </button>
                                                                <ul class="dropdown-list">
                                                                    @foreach ($brands as $brand)
                                                                    <li>
                                                                        <input type="checkbox" name="brands[]"
                                                                            value="{{$brand->id}}">
                                                                        <label for="">{{$brand->BrandName}}</label>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="group-filter dropdown">
                                                            <div class="layered-sub">
                                                                <button class="price-btn btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    GIÁ
                                                                </button>
                                                                <ul class="dropdown-list">
                                                                    <li>
                                                                        <input type="checkbox" value="under-1000000" name="price[]">
                                                                        <label for="" >dưới 1.000.000đ</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" value="1000000-2000000" name="price[]">
                                                                        <label for="" >1.000.000đ - 2.000.000đ</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" value="2000000-3000000" name="price[]">
                                                                        <label for="" >2.000.000đ - 3.000.000đ</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" value="3000000-5000000" name="price[]">
                                                                        <label for="" >3.000.000đ - 5.000.000đ</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="checkbox" value = "over-5000000" name="price[]">
                                                                        <label for="">trên 5.000.000đ</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="filter-product-categories">
                            <div class="wrap-collection-title">
                                <div class="heading-collection row">
                                    <div class="col-md-8 col-sm-12 col-xs-12 heading-card">
                                        <h1 style="font-size: 28px;">{{$category->CatName}}</h1>
                                    </div>
                                    <div class="filter-product-site col-md-4">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="filter-here">
                                <div class="row product-list">
                                    @foreach($productsWithImages as $item)
                                    <div class="col-md-3 col-sm-6 col-xs-6 product">
                                        <div class="product_block">
                                            <div class="product-img">
                                                <a href="{{ route('detail.product', ['id' => $item['product']->id]) }}">
                                                    <picture class="pt1">
                                                        <img src="{{ asset($item['image1']) }}" alt="">
                                                    </picture>
                                                    <picture class="pt2">
                                                        <img src="{{ asset($item['image2']) }}" alt="">
                                                    </picture>
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
                                                        <a href="{{ route('detail.product', ['id' => $item['product']->id]) }}"> {{ $item['product']->ProductName }} </a>
                                                    </h3>
                                                    <div class="pro-price">
                                                        <p>{{ $item['product']->Price }} </p>
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
        </div>
    </main>
    @endsection
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>


<script>
    // Đảm bảo mã JavaScript được gọi sau khi trang đã tải xong
    $(document).ready(function () {
        // Hàm thực hiện yêu cầu AJAX và cập nhật danh sách sản phẩm
        function filterProducts() {
            const selectedBrands = $('input[name="brands[]"]:checked').map(function () {
                return this.value;
            }).get();
            const priceRanges = $('input[name="price[]"]:checked').map(function () {
                return this.value;
            }).get();
            const urlParams = new URLSearchParams(window.location.search);
            const category = urlParams.get('category');
            console.log(selectedBrands);
            console.log(priceRanges);
            $.ajax({
                type: 'GET',
                url: '{{ route('filter.products') }}',
                data: { brands: selectedBrands, category: category, priceRanges: priceRanges },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Xóa danh sách sản phẩm hiện có
                    $('.product-list').empty();

                    // Lặp qua kết quả và thêm các sản phẩm đã lọc vào danh sách
                    response.products.forEach(function (product) {
                        const formattedPrice = product.product.Price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                        const productHTML = `
        <div class="col-md-3 col-sm-6 col-xs-6 product">
          <div class="product_block">
            <div class="product-img">
              <a href="product-detail?id=${product.product.id}">


                <picture class="pt1">
                  <img src="${product.image1}" alt="">
                </picture>
                <picture class="pt2">
                  <img src="${product.image2}" alt="">
                </picture>
              </a>
              <div class="button-add">
              <form id="product-form" action="{{ route('add.to.cart') }}" method="POST" enctype="multipart.form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value=" ${product.product.id} ">
                                                        <input type="hidden" name="ProductName" value="${product.product.ProductName} ">
                                                        <input type="hidden" name="Price" value=" ${product.product.Price} ">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <input type="hidden" name="size" value=" ${product.size} ">
                                                        <input type="hidden" name="URL" value=" ${product.image1} ">
                                                        <button class="tobuy" formaction=" {{route('buy.now')}} ">Buy</button>
                                                        <button type="submit" class="tocart">Add to cart</button>
                                                    </form>
              </div>
            </div>
            <div class="product-detail">
              <div class="box-pro-details">
                <h3 class="pro-name">
                  <a href="product-detail?id=${product.product.id}"> ${product.product.ProductName} </a>
                </h3>
                <div class="pro-price">
                  <p>${formattedPrice}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
                        $('.product-list').append(productHTML);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

        }

        // Thêm lắng nghe sự kiện cho biểu mẫu lọc
        $('#filter-form').on('change', function (e) {
            e.preventDefault();
            filterProducts();
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    const brandBtn = document.querySelector(".brand-btn");
    const priceBtn = document.querySelector(".price-btn");
    const dropdownList = document.querySelector(".dropdown-list");

    priceBtn.addEventListener("click", function () {
        const isExpanded = priceBtn.getAttribute("aria-expanded") === "true";
        priceBtn.setAttribute("aria-expanded", !isExpanded);
    });
    brandBtn.addEventListener("click", function () {
        const isExpanded = brandBtn.getAttribute("aria-expanded") === "true";
        brandBtn.setAttribute("aria-expanded", !isExpanded);
    });
});

</script>

</html>