<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/brand.css') }}">
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
            <h1>Quản lí Thương hiệu</h1>
            <form action="{{route('add.brand')}}" method = "POST">
            @csrf
            <label for="">New brand</label>
            <input type="text" name = "BrandName">
            @error('BrandName')                      
            <p class="text-danger">{{ $message }}</p>
            @enderror
            
            <label for="">Catalog</label>
            <select name="category_id" id="">
                @foreach($categories as $category)
                <option value="{{$category->id}}" @if ($category->id == 1) selected @endif >{{$category->CatName}}</option>
                @endforeach
            </select>
            
            <button class="btn-add">Thêm sản thương hiệu</button>
            </form>
        </div>
    </div>
    <div class="cards">
        <div class="card-single">
            <div class="card-flex">
                <div class="card-info">
                    <div class="card-head">
                        <span>Thương hiệu</span>
                        <small>Tổng số thương hiệu</small>
                    </div>
                    <h2>{{$countBrand}}</h2>
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
        <a href="{{route('show.admin.brand')}}">
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
                                <th class="name-prod">Brand</th>
                                <th class="cate-prod">Category</th>
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
                                <td class="status-prod-content">
                                    @if($item['brand']->BraStatus == 1)
                                    <span class="done">Duyệt</span>
                                    @else
                                    <span class="Ndone">Chưa duyệt</span>
                                    @endif
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