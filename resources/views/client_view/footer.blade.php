<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>

<body>
    <footer>
        <div class="container" style="padding: 0;">
            <div class="sec aboutus">
                <h2>Giới thiệu</h2>
                <p>Tại cửa hàng của chúng tôi, phụ vụ nhu cầu của khách hàng là điều quan trọng nhất. Chúng tôi đem đến những mẫu giày mới nhất, đa dạng và đảm bảo về chất lượng sản phẩm</p>  
            </div>
            <div class="sec quickLinks">
                <h2>Chính sách</h2>
                <ul style="padding-left: 0;">
                    <li> <a href="{{route('static')}}">Chính sách thanh toán</a></li>
                    <li> <a href="{{route('static')}}">Chính sách bảo mật</a></li>
                </ul>
            </div>
            <div class="sec quickLinks">
                <h2>Mục lục</h2>
                <ul style="padding-left: 0;">
                    <li> <a href="{{ route('category', ['category' => '1']) }}">Sneaker</a></li>
                    <li> <a href="{{ route('category', ['category' => '2']) }}">Slide</a></li>
                    <li> <a href="{{ route('category', ['category' => '3']) }}">Bag-Clothing</a></li>
                    <li> <a href="{{ route('category', ['category' => '4']) }}">Accessories</a></li>
                </ul>
            </div>
            <div class="sec contact">
                <h2>Liên hệ</h2>
                <ul class="info" style="padding-left: 0;">
                    <li>
                        <span><i class="fa-solid fa-phone"></i></span><p><a
                         href="tell:+12345678900">+84 65 380 226</a></p>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-envelope"></i></span><p><a
                         href="mailto:abc@email.me">nhom7CNPM@email.com</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>