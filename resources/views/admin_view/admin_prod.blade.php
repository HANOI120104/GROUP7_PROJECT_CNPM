<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet"href="{{ asset('css/admin_prod.css') }}">
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
    <div class="page-header">
        <div>
            <h1>Quản lí sản phẩm</h1>
            <button class="btn-add"><a href="{{route('show.add.product')}}">Thêm sản phẩm mới</a></button>
        </div>
    </div>
    <div class="cards">
        <div class="card-single">
            <div class="card-flex">
                <div class="card-info">
                    <div class="card-head">
                        <span>Sản phẩm</span>
                        <small>Tổng số sản phẩm</small>
                    </div>
                    <h2>{{$countProduct}}</h2>
                </div>
                <div class="card-chart edit">
                    <i class="fa-solid fa-bag-shopping" style="color: #1e940e;"></i>
                </div>
            </div>
        </div>
        <div class="card-single">
            <div class="card-flex">
                <div class="card-info">
                    <div class="card-head">
                        <span>Phân loại sản phẩm</span>
                        <small>số loại sản phẩm</small>
                    </div>
                    <h2>4</h2>
                </div>
                <div class="card-chart delete">
                    <i class="fa-solid fa-rectangle-list" style="color: #e7e415;"></i>
                </div>
            </div>
        </div>
        <a href="{{route('show.admin.product')}}">
            <div class="card-single">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Sản phẩm chưa duyệt</span>
                            <small>Tổng số sản phẩm chưa duyệt</small>
                        </div>
                        <h2>{{$countAdminProduct}}</h2>
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
                                <th class="image-prod">Ảnh</th>
                                <th class="name-prod">Sản phẩm</th>
                                <th class="cate-prod">Loại</th>
                                <th class="brand-prod">Hãng</th>
                                <th class="price-prod">Giá</th>
                                <th class="quan-prod">SL</th>
                                <th class="status-prod">Trạng thái</th>
                                <th class="btn-prod">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($productsWithImages as $item)    
                            <tr>
                                <td>{{$item['product']->id}}</td>
                                <td><img src="{{ asset($item['image']) }}"
                                        alt=""></td>
                                <td>{{$item['product']->ProductName}}</td>
                                <td>{{$item['category']}}</td>
                                <td>{{$item['brand']}}</td>
                                <td>{{number_format($item['product']->Price)}} đ</td>
                                <td>{{$item['total_quantity']}}</td>
                                <td>
                                    @if($item['product']->ProductStatus == 1)
                                    <span class="done">Duyệt</span>
                                    @else
                                    <span class="Ndone">Chưa duyệt</span>
                                    @endif
                                </td>
                                <td class="control">
                                    <a href="{{ route('product.detail', $item['product']->id) }}">
                                        <button class="btn-view"><i class="fa-solid fa-eye"></i></button>
                                    </a>
                                    <a href="{{ route('edit.product', $item['product']->id) }}">
                                        <button class="btn-edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </a>
                                    <form action="{{ route('delete.product', $item['product']->id) }}" method="POST" onsubmit="return ConfirmDelete( this )">
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