<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet"href="{{ asset('css/addprod.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

<body>
    @extends('admin_view.header')
    @section('admin')
    <div class="job-grid">
        <div class="jobs">
            <div class="table-responsive">
                <div class="container">
                    <div class="title">Thêm Sản Phẩm</div>
                    <div class="content">
                        <form action="{{route('add.product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Name</span>
                                    <input type="text" name="ProductName" placeholder="Name">
                                    @error('ProductName')                      
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details">Category</span>
                                    <select name="category_id" class="cate-op">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->CatName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-box">
                                    <span class="details">Brand</span>
                                    <select name="brand_id" class="cate-op">
                                    </select>
                                </div>
                                <div class="input-box">
                                    <span class="details">Description</span>
                                    <input type="text" name="ProductDescription" placeholder="Description">
                                    @error('ProductDescription')                      
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input-box">
                                    <span class="details">Price</span>
                                    <input type="text" name="Price" placeholder="Price">
                                    @error('Price')                      
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input-box">
                                    <input type="hidden">
                                </div>
                                <div class="input-box">
                                    <span class="details">Images</span>
                                    <input type="file" name="img1" id="fileInput" onchange="previewImage()" accept="image/*">
                                    <img id="preview" src="" alt="Preview Image">
                                    @error('img1')                      
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-box img-link">
                                    <input type="file" name="img2" id="fileInput2" onchange="previewImage()" accept="image/*">
                                    <img id="preview2" src="" alt="Preview Image">
                                    @error('img2')                      
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="button">
                                    <input type="submit" value="Thêm Sản Phẩm">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
        function previewImage() {
            var preview = document.querySelector('#preview');
            var file = document.querySelector('#fileInput').files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }

            // Tương tự, xử lý hình ảnh thứ 2 nếu cần
            var preview2 = document.querySelector('#preview2');
            var file2 = document.querySelector('#fileInput2').files[0];
            var reader2 = new FileReader();

            reader2.onloadend = function () {
                preview2.src = reader2.result;
            }

            if (file2) {
                reader2.readAsDataURL(file2);
            } else {
                preview2.src = "";
            }
        }
</script>
<script>
$(document).ready(function() {
    // Lắng nghe sự kiện thay đổi trong select box có class "cate-op"
    $('select[name="category_id"]').change(function() {
        var category_id = $(this).val();
        console.log(category_id);
        // Gửi yêu cầu AJAX đến route 'get-brands' với category_id
        $.ajax({
            type: "POST",
            url: '/get-brands', // Thay đổi URL này để phù hợp với tên route của bạn
            data: { category_id: category_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function(data) {
                // Xóa tất cả các option hiện có trong select box brand
                $('select[name="brand_id"]').empty();


                // Thêm các option mới dựa trên danh sách thương hiệu từ phản hồi AJAX
                $.each(data, function(index, brand) {
                var option = $('<option>', {
                    value: brand.id,
                    text: brand.BrandName
                });

                // Nếu đây là brand đầu tiên trong danh sách, chọn nó mặc định
                if (index === 0) {
                    option.prop('selected', true);
                }

                $('select[name="brand_id"]').append(option);
            });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    // Lắng nghe sự kiện thay đổi trong select box có class "cate-op"
    $('select[name="brand_id"]').change(function() {
        var brand_id = $(this).val();
        console.log(brand_id);
        
    });

    // Thiết lập giá trị mặc định cho category_id
    var defaultCategoryId = 1;
    $('select[name="category_id"]').val(defaultCategoryId).change();
});


</script>
</body>
</html>