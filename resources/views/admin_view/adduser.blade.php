<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/adduser.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    @extends('admin_view.header')
    @section('admin')
    @if (auth()->user()->level == 0)
    <h1>Bạn không có quyền truy cập</h1>
    @else
    <div class="page-header">
        <div>
            <h1>Quản lí Nhân Viên</h1>
            
        </div>
    </div>
    <div class="job-grid">
        <div class="jobs">
            <div class="table-responsive">
                <div class="container">
                    <div class="title">Thêm Tài Khoản</div>
                    <div class="content">
                        <form action="{{route('add.user')}}" method="POST">
                            @csrf
                            <div class="user-details">
                                
                                <div class="input-box">
                                    <span class="details">Tên</span>
                                    <input type="text"  name="name">
                                    @error('name')
                                    <p style ="color: red;">{{$message}}</p>
                                    @enderror
                                </div>
                                
                                <div class="input-box">
                                    <span class="details">Email</span>
                                    <input type="text" name="email">
                                    @error('email')
                                    <p style ="color: red;">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="input-box">
                                    <span class="details">Vai trò</span>
                                    <select id="" name = "level">
                                        <option value="1">Quản lý</option>
                                        <option value="0" selected>Nhân viên</option>
                                    </select>
                                </div>
                                    
                                <div class="input-box">
                                    <span class="details">Mật khẩu</span>
                                    <input type="password"  name="password">
                                    @error('password')
                                    <p style ="color: red;">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="input-box">
                                    <span class="details">Nhập lại mật khẩu</span>
                                    <input type="password"  name="password_confirmation">
                                    @error('password_confirmation')
                                    <p style ="color: red;">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="button">
                                <input type="submit" value="Thêm Tài khoản">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection
</body>

</html>