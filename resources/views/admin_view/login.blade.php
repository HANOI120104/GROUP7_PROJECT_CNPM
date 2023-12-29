<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<body>
  <div class="wrapper">
    <div class="container main">    
        <div class="row">
            <div class="col-md-6 side-image" style = "background-image: url({{asset('img/1.jpg')}})">                
            </div>

            <div class="col-md-6 right">
                
                <div class="input-box">
                   
                   <header>Login</header>
                   <form action="{{route('admin.login')}}" method="POST">
                    @csrf
                        <div class="input-field">
                            <input type="text" class="input" id="username" name="email" >
                            <label for="username">Email</label> 
                            @error('email')
                            <p>{{$message}}</p>
                            @enderror
                            </div> 
                        <div class="input-field">
                            <input type="password" class="input" id="pass" name="password" >
                            <label for="pass">Password</label>
                            @error('password')
                            <p>{{$message}}</p>
                            @enderror
                        </div> 
                        <div class="input-field mt-2">
                            <input type="submit" class="submit" value="Login">
                        </div> 
                   </form>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>