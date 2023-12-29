<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
     
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">  
</head>

<body>
    <input type="checkbox" name="" id="sidebar-toggle">

    <div class="sidebar">
        <div class="sidebar-main">
            <div class="sidebar-user">
                <img src="{{ asset('img/user.jpg') }}" alt="">
                
            </div>
            <div class="wel">
                <p>Chào: {{ auth()->user()->name }}</p>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="fa-solid fa-table"></i>   
                        Trang chủ
                    </a>
                </li>
                <li>
                    <a href="{{route('show.user')}}">
                        <i class="fa-solid fa-user"></i>
                        Quản lí nhân viên
                    </a>
                </li>
                <li>
                    <a href="{{route('show.customer')}}">
                        <i class="fa-solid fa-user"></i>
                        Quản lý người dùng
                    </a>
                </li>
                <li>
                    <a href="{{route('show.product')}}">
                        <i class="fa-sharp fa-solid fa-table-list"></i>
                        Quản lí sản phẩm
                    </a>
                </li>
                <li>
                    <a href="{{route('show.order')}}">
                        <i class="fa-solid fa-list-check"></i>
                        Quản lí đơn hàng
                    </a>
                </li>
                <li>
                    <a href="{{route('show.brand')}}">
                        <i class="fa-sharp fa-solid fa-table-list"></i>
                        Quản lí thương hiệu
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label for="sidebar-toggle">
                    <span class="las la-bars"></span>
                </label>
            </div>
            <div class="header-icons">
            
                <form action="{{route('admin.logout')}}" method="POST">
                            @csrf
                            <button type = "submit" style="border: none; background: #fff;"><span>Đăng xuất</span><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                        </form>

            </div>
        </header>
        <main>
            
            @yield('admin')

        </main>
    </div>
    <label for="sidebar-toggle" class="body-label"></label>
</body>

</html>