<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="../css/brand.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
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
            <button class="btn-add"><a href="{{route('show.add.user')}}">Thêm tài khoản mới</a></button>
        </div>
    </div>
    <div class="page-header">
        <div>
            <h1>Quản lí Thương hiệu</h1>

        </div>
    </div>
    <div class="cards">
        <a href="">
            <div class="card-single">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Thương hiệu chưa duyệt</span>
                            <small>Tổng số thương hiệu chưa duyệt</small>
                        </div>
                        <h2>{{$countAdminBrand}}</h2>
                    </div>
                    <div class="card-chart yellow">
                        <i class="fa-solid fa-clipboard-check" style="color: #ee2a2a;"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="job-grid" style="margin-top: 20px">
        <div class="jobs">
            <div class="table-responsive">
                <div class="container">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th class="id-prod">ID</th>
                                <th class="name-prod">Brand Name</th>
                                <th class="cate-prod">Category_id</th>
                                <th class="status-prod">Trạng thái</th>
                                <th class="btn-prod">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brandWithCategory as $item)
                            <tr>
                                <td>{{$item['brand']->id}}</td>
                                <td>{{$item['brand']->BrandName}}</td>
                                <td>{{$item['category']}}</td>
                                <td>
                                <form action="{{ route('approve.brand', $item['brand']->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                        <button class="btn-status">Duyệt</button>
                                    </form>
                                </td>
                                <td class="control">
                                    <a href="{{route('edit.brand',$item['brand']->id )}}">
                                        <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </a>
                                    <form action="{{route('delete.brand',$item['brand']->id )}}" method="POST" onsubmit="return ConfirmDelete( this )">
                                    @csrf
                                        @method('DELETE')
                                        <button class="btn-delete" type="submit"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
</body>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthMenu": [5, 10, 15],

            "searching": true,
            "searchDelay": 500,

            "ordering": true,
            "order": [[1, 'desc']],

            "lengthChange": true,
            "info": true,
            "pagingType": "full_numbers",

            "language": {
                "lengthMenu": "Hiển thị _MENU_ hàng trên mỗi trang",
                "search": "Tìm kiếm:",
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ hàng",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            }
        });
    });
</script>

</html>