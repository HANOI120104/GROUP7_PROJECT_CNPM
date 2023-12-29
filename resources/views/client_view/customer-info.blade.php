<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="user-detail.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/customer-info.css') }}">


</head>
<body>
    @extends('client_view.frontend')
    @section('content')
    <div class="user-detail-container">
        <div class="user-detail-heading">
            <h1>Tài khoản của bạn</h1>
        </div>
        <div class="row">
            <div class="account col-lg-3">
                <div class="account-user-heading">
                    <h3>TÀI KHOẢN</h3>
                </div>
                <ul class="option-user">
                    <li>
                        <a href="{{route('customer.info')}}">Thông tin tài khoản</a>
                    </li>
                    <li>
                        <a href="{{route('client.edit.customer', $customer->id)}}">Thay đổi thông tin</a>
                    </li>
                    <li>
                        <form action="{{route('customer.logout')}}" method="POST">
                            @csrf
                            <button type = "submit" style="border: none">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
    
            </div>
            <div class="user-detail-content col-lg-7">
                <div class="user-info">
                    <h3>THÔNG TIN TÀI KHOẢN</h3>
                </div>
                <div class="user-detail-info">
                    <p>Họ và tên: {{$customer->name}}</p>
                    <p>Email: {{$customer->email}}</p>
                </div>
                <div class="list-order-user">
                    <h3>Lịch sử mua hàng</h3>
                    <table id="myTable" class="table-history-order">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bought as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->created_at->format('d-m-Y') }}</td>
                                <td>{{number_format($item->Total)}}đ</td>
                                @if($item->Status == 0)
                                <td>Đang chuẩn bị hàng</td>
                                @else
                                <td>Đang giao hàng</td>
                                @endif
                                
                                @if($item->Status == 0)
                                <td>
                                <form action="{{ route('client.delete.order', $item->id) }}" method="POST" onsubmit="return ConfirmDelete( this )">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-cancel">Hủy đơn</button>
                                    </form>
                                </td>
                               
                                @endif
                                
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
        $(document).ready(function() {
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