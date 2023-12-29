<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/edit_prod.css') }}">
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
                <form action="{{ route('update.brand', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                    @csrf
                <div class="container">
                    <div class="title">Sửa Thương Hiệu</div>
                    <div class="content">
                        <div class="title-sub">Thông tin thương hiệu</div>
                        <div class="prod-details">
                            <div class="input-box">
                                <span class="details">Brand</span>
                                <input type="text" name="BrandName" value="{{$brand->BrandName}}">
                                @error('BrandName')                      
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input-box">
                                <span class="details">Category</span>
                                <select name="category_id" id="" class="cate-op">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if ($category->id == $brand->category_id) selected @endif >{{$category->CatName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-box">
                                <span class="details"></span>
                                <input type="hidden">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container" style="margin-top: 50px;">
                    <div class="button-submit">
                        <input type="submit" value="Cập nhật">
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
    @endsection
</body>

</html>