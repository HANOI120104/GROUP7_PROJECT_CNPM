<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

</head>

<body>
    @include('client_view.header')

    @yield('content')

    @include('client_view.footer')

    <script>
        // Sử dụng sự kiện DOMContentLoaded để đảm bảo mã JavaScript chỉ được thực thi khi DOM đã tải
        document.addEventListener("DOMContentLoaded", function() {
            let priceElements = document.querySelectorAll(".pro-price p");

            // Lặp qua tất cả các phần tử chứa giá tiền và chuyển đổi sang định dạng tiền tệ
            priceElements.forEach(function(element) {
                let price = parseFloat(element.innerText.replace("đ", "").replace(/\./g, ""));
                let formattedPrice = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
                element.innerText = formattedPrice;
            });
        });
    </script>
</body>

</html>