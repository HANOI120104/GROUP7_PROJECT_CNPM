<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

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
                    <div class="title">Thông tin sản phẩm</div>
                    <div class="content-info">
                        <p>Id: <span>{{$product->id}}</span></p>
                        <p>Tên sản phẩm: <span>{{$product->ProductName}}</span></p>
                        <p>Loại sản phẩm: <span>{{$category[0]}}</span></p>
                        <p>Hãng: <span>{{$brand[0]}}</span></p>
                        <p>Giá: <span>{{number_format($product->Price)}}</span>đ</p>
                        <p>Mô tả: <span>{{$product->ProductDescription}}</span></p>
                    </div>
                </div>
                <div class="container" style="margin-top: 50px;">
                    <div class="title-sub">Size</div>
                    <div class="add-size">
                        <form action="{{ route('add.size')}}" method="POST">
                            @csrf
                            <!-- Tên size -->
                            <input type="hidden" name="product_id" value=" {{$product->id}} ">
                            <label for="size_name">New size</label>
                            <input type="text" name="SizeName" id="size_name">
                            @error('SizeName')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <!-- Số lượng -->
                            <label for="quantity">Quantity</label>
                            <input type="number" name="Quantity" id="quantity">
                            @error('Quantity')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <!-- Button thêm size -->
                            <div class="btn-add-size">
                                <button type="submit">Thêm size</button>
                            </div>
                        </form>
                    </div>
                    <table id="table-size">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sizes as $size)
                            <tr>
                                <form action="{{ route('update.size',$size->id )}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name="product_id" value=" {{$product->id}} ">
                                <td>{{$size->id}}</td>
                                <td><input type="text" value="{{$size->SizeName}}" name="SizeName"></td>
                                <td><input type="number" value="{{$size->Quantity}}" name="Quantity"></td>
                                
                                <td>
                                    <button class="btn-edit">Update</button>
                                    </form>
                                    <form action="{{ route('delete.size', $size->id) }}" method="POST" onsubmit="return ConfirmDelete( this )">
                                        @csrf
                                        @method('DELETE')
                                    <button class="btn-delete">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="container" style="margin-top: 50px;">
                    <div class="title-sub">Hình ảnh</div>

                    <div class="add-img">
                    <form action="{{ route('add.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="">New img</label>
                        <input type="hidden" name="product_id" value=" {{$product->id}} ">
                        <input type="file" name="URL" id="fileInput" onchange="previewImage()" accept="image/*">
                                    <img id="preview" src="" alt="Preview Image" width= "100px">
                                    @error('URL')                      
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                        <div class="btn-add-image">
                            <button>Thêm hình ảnh</button>
                        </div>
                    </form>
                    </div>
                    <table id="table-img">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Img</th>
                                <th>URL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                            <tr>
                                <td class="id-img">{{$image->id}}</td>
                                <td class="img-img"><img
                                        src="{{asset($image->URL)}}"
                                        alt=""></td>
                                <form action="{{ route('update.image',$image->id )}}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name="product_id" value=" {{$product->id}} ">
                                <td class="link-img"><input type="file" name="URL" id="fileInput2" onchange="previewImage()" accept="image/*">
                                    
                                    @error('URL')                      
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror</td>
                                <td>
                                    <button class="btn-edit">Update</button>
                                </form>
                                <form action="{{ route('delete.image', $image->id) }}" method="POST" onsubmit="return ConfirmDelete( this )">
                                        @csrf
                                        @method('DELETE')
                                    <button class="btn-delete">Delete</button>
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
        }
</script>

</html>