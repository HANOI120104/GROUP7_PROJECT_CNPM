<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin_order.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
    @extends('admin_view.header')
    @section('admin')
    <div class="page-header">
        <div>
            <h1>Quản lí Đơn Hàng</h1>
        </div>
    </div>
    <div class="cards">
        <div class="card-single">
            <div class="card-flex">
                <div class="card-info">
                    <div class="card-head">
                        <span>Đơn hàng</span>
                        <small>Tổng đơn hàng</small>
                    </div>
                    <h2>{{$countTotalOrder}}</h2>
                </div>
                <div class="card-chart edit">
                    <i class="fa-solid fa-bag-shopping" style="color: #dddfe3;"></i>
                </div>
            </div>
        </div>
        <div class="card-single">
            <div class="card-flex">
                <div class="card-info">
                    <div class="card-head">
                        <span>Đơn được duyệt</span>
                    </div>
                    <h2>{{$countOrder1}}</h2>
                </div>
                <div class="card-chart delete">
                    <i class="fa-solid fa-bag-shopping" style="color: #dddfe3;"></i>
                </div>
            </div>
        </div>
        <div class="card-single">
            <div class="card-flex">
                <div class="card-info">
                    <div class="card-head">
                        <span>Doanh thu</span>
                    </div>
                    <h2>{{number_format($sumTotal)}} đ</h2>
                </div>
                <div class="card-chart yellow">
                    <i class="fa-solid fa-bag-shopping" style="color: #dddfe3;"></i>
                </div>
            </div>
        </div>
        <div class="card-single">
            <div class="card-flex">
                <div class="card-info">
                    <div class="card-head">
                        <span>Đơn chưa duyệt</span>
                    </div>
                    <h2>{{$countOrder2}}</h2>
                </div>
                <div class="card-chart yellow">
                    <i class="fa-solid fa-bag-shopping" style="color: #dddfe3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="job-grid">
        <div class="jobs">
            <div class="table-responsive">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th class="id-prod">Mã</th>
                            <th class="total-prod">Họ tên</th>
                            <th class="date-prod">Số điện thoại</th>
                            <th class="date-prod">Địa chỉ</th>
                            <th class="total-prod">Tổng thanh toán</th>
                            <th class="user-prod">Người duyệt</th>
                            <th class="btn-prod">Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderWithUser as $item)
                        <tr>
                            <td>{{$item['order']->id}}</td>
                            <td>{{$item['order']->fullname}}</td>
                            <td>{{$item['order']->phone}}</td>
                            <td>{{$item['order']->address}}</td>
                            <td>{{number_format($item['order']->Total)}} đ</td>
                            <td>{{$item['user']}}</td>
                            <td>
                                @if($item['order']->Status == 0)
                                <a href="{{route('show.order.detail',$item['order']->id )}}" class="btn-comf">Duyệt</a>
                                @else
                                <a href="{{route('show.order.detail',$item['order']->id )}}" >Chi Tiết</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
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