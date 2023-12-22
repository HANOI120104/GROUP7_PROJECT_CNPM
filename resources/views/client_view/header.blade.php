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
    <link rel="stylesheet" href="{{ asset('css/client_header.css') }}">
</head>

<body>
    <div class="container-header">
        <div class="promo-bar">
            <a href="">
                <span>SNEAKER & CLOTHING AUTHENTIC 100%</span>
            </a>
        </div>
        <header id="main-header">
            <div class="container-main-header">
                <div class="row desk-menu">
                    <div class="logo col-md-2 col-sm-5 col-5">
                        <div class="header-logo">
                            <a href="/">BOSS GIAY</a>
                        </div>
                    </div>

                    <div class="navbar-menu col-md-7 col-sm-7 col-7">
                        <div class="main-header--menu">
                            <nav class="navbar navbar-expand-lg">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a href="{{ route('category', ['category' => '1']) }}" style="margin: 0; padding: 0;">SNEAKER</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('category', ['category' => '2']) }}" style="margin: 0; padding: 0;">SLIDE</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('category', ['category' => '3']) }}" style="margin: 0; padding: 0;">BAG-CLOTHING</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('category', ['category' => '4']) }}" style="margin: 0; padding: 0;">ACCESSORIES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('contact')}}" style="margin: 0;">LIÊN HỆ</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="icon col-md-2 col-sm-7 col-7">
                        <div class="main-header-action row">
                            <div class="action--acc col-3">
                                <a href="{{route('customer.info')}}">
                                    <i class="fa-regular fa-user"></i>
                                </a>
                            </div>
                            <div class="action--search col-3">
                                <a href="" class="click-search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </div>
                            <div class="action--cart col-3">
                                <a href="{{route('show.cart')}}" >
                                    <i class="fa-solid fa-cart-plus"><span class="count"></span></i>
                                </a>
                            </div>
                            <div class="action--nav col-3">
                                <a href="" class="click-menu">
                                    <i class="fa-solid fa-bars"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-section">
                <div class="top-search" style="position: relative;">
                    <h2>TÌM KIẾM</h2>
                    <button class="close01" style="position: absolute; top:0px; right: 0px;"><i
                            class="fa-solid fa-x"></i></button>
                </div>

                <div class="form-search">
                    <form action="{{ route('product.search') }}" method="POST">
                        @csrf
                        <input type="text" name="keyword"  placeholder="Tìm kiếm sản phẩm">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                

            </div>
        </header>
    </div>
    <div class="container02">

    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clickMenuLink = document.querySelector('.click-menu');
        const navbarMenu = document.querySelector('.navbar-menu');
        const clickSearchLink = document.querySelector('.click-search');
        const clickCartLink = document.querySelector('.click-cart');
        const searchSection = document.querySelector('.search-section');
        const cartSection = document.querySelector('.cart-section');
        const closeButton01 = document.querySelector('.close01');
        const closeButton02 = document.querySelector('.close02');
        const container02 = document.querySelector('.container02');

        clickMenuLink.addEventListener('click', function (event) {
            event.preventDefault();

            if (navbarMenu.style.display === 'none') {
                navbarMenu.style.display = 'block';

            } else {
                navbarMenu.style.display = 'none';
            }
        });

        clickSearchLink.addEventListener('click', function (event) {
            event.preventDefault();

            if (searchSection.style.display === 'none') {
                searchSection.style.display = 'block';
                container02.style.display = 'block';
            } else {
                searchSection.style.display = 'none';
                container02.style.display = 'none';
            }
        });
        closeButton01.addEventListener('click', function () {
            searchSection.style.display = 'none';
            container02.style.display = 'none';
        });
        clickCartLink.addEventListener('click', function (event) {
            event.preventDefault();

            if (cartSection.style.display === 'none') {
                cartSection.style.display = 'block';
                container02.style.display = 'block';
            } else {
                cartSection.style.display = 'none';
                container02.style.display = 'none';
            }
        });

        closeButton02.addEventListener('click', function () {
            cartSection.style.display = 'none';
            container02.style.display = 'none';
        });
    });
    const header = document.getElementById('main-header');
    const scrollTriggerDistance = 200; // Khoảng cách cuộn (pixel) để kích hoạt fixed

    window.addEventListener('scroll', function () {
        // Kiểm tra vị trí cuộn hiện tại
        const scrollY = window.scrollY || window.pageYOffset;

        // Kích hoạt hoặc tắt class 'fixed' cho header tùy thuộc vào vị trí cuộn
        if (scrollY >= scrollTriggerDistance) {
            header.classList.add('fixed');
        } else {
            header.classList.remove('fixed');
        }
    });
    // Hàm để thêm dấu phẩy vào số
    function formatNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // Lấy tất cả các phần tử có class "pro-price-view"
    const priceElements = document.querySelectorAll('.pro-price-view');

    // Định dạng số cho từng phần tử
    priceElements.forEach(function (element) {
        const priceValue = parseInt(element.textContent, 10);
        element.textContent = formatNumberWithCommas(priceValue);
    });


</script>



</html>