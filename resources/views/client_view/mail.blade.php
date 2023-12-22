<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SendMail</title>
</head>
<body>
    @csrf
    <h1>Xác nhận đơn hàng</h1>
    <p>Cảm ơn bạn đã mua hàng tại shop</p>
    
    <h2>Chi tiết đơn hàng</h2>
    <table class="myTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Img</th>
                <th>Size Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach (\Cart::getContent() as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ asset($item->attributes->url) }}" width="100px" alt=""></td>
                    <td>{{ $item->attributes->size }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }} đ</td>
                    <td>{{ number_format($item->quantity * $item->price) }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
