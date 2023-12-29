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
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>

<body>
    @extends('admin_view.header')
    @section('admin')
            <div class="job-grid">
                <div class="jobs">
                    <div class="table-responsive">
                        <div class="container">
                            <div class="title">Thay đổi thông tin</div>
                            <div class="content">
                                <form action="{{ route('update.user', $user->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    
                                    <div class="user-details">
                                        @error('name')
                                        <div class="notify-register">
                                            <p style ="color: red;">{{$message}}</p>
                                        </div>
                                        @enderror
                                        <div class="input-box">
                                            <span class="details">Tên</span>
                                            <input type="text"  name="name" value = "{{ $user->name }}">
                                        </div>
                                        @error('email')
                                        <div class="notify-register">
                                            <p style ="color: red;">{{$message}}</p>
                                        </div>
                                        @enderror
                                        <div class="input-box">
                                            <span class="details">Email</span>
                                            <input type="text" name="email" value = "{{ $user->email }}">
                                        </div>
                                        @if ($user->level == 0)
                                        <div class="input-box">
                                            <span class="details">Vai trò</span>
                                            <select id="" name = "level">
                                                <option value="1">Quản lý</option>
                                                <option value="0" selected>Nhân viên</option>
                                            </select>
                                        </div>
                                        @else
                                        <div class="input-box">
                                            <span class="details">Vai trò</span>
                                            <select id="" name = "level">
                                                <option value="1"selected>Quản lý</option>
                                                <option value="0">Nhân viên</option>
                                            </select>
                                        </div>
                                        @endif
                                        
                                    </div>
                                    <div class="button">
                                        <input type="submit" value="Cập nhập">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
</body>

</html>