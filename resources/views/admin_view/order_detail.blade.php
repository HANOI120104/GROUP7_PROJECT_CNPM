<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER DETAIL</title>
    <link rel="stylesheet" href="{{ asset('css/order_detail.css') }}">
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
    <div class="job-grid">
        <div class="jobs">
            <div class="table-responsive">
                <div class="container">
                    <div class="title">Đơn hàng <span>#{{$order->id}}</span></div>
                    <div class="customer-info">
                        <p><span class="bold-content">Họ và tên</span>: {{$order->fullname}}</p>
                        <p><span class="bold-content">Số điện thoại</span>: {{$order->phone}}</p>
                        <p><span class="bold-content">Email</span>: {{$order->email}}</p>
                        <p><span class="bold-content">Địa chỉ</span>: {{$order->address}}</p>

                    </div>
                    <div class="bill-info">
                        <h3>TỔNG GIÁ TRỊ ĐƠN HÀNG: <span class="bill-content">{{number_format($order->Total)}}</span>VND</h3>
                    </div>
                    <div class="content" style="margin: 20px 0;">
                        <table id="myTable" style="margin: 20px 0;">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Kích cỡ</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_detail as $item)
                                <tr>
                                    <td>{{$item->product_id}}</td>
                                    <td>{{$item->ProductName}}</td>
                                    <td>{{$item->SizeName}}</td>
                                    <td>{{$item->Price}}đ</td>
                                    <td>{{$item->Quantity}}</td>
                                    <td>{{number_format($item->Price * $item->Quantity)}}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="button">
                            <form action="{{ route('delete.order', $order->id) }}" method="POST" onsubmit="return ConfirmDelete( this )">
                                        @csrf
                                        @method('DELETE')
                            <input class="cancel" type="submit" value="Hủy đơn hàng">
                            </form>
                            @if ($order->Status == 0)
                            <form action="{{ route('approve.order', $order->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                            <input class="comfirm" type="submit" value="Duyệt đơn hàng">
                            </form>
                            @endif
                        </div>

                    </div>
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