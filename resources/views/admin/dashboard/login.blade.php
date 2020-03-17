<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị Website</title>
    <link rel="stylesheet" href="{{ asset('public/backend/libs/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/libs/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/libs/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/tuan-style.css') }}">
</head>

<body>
    <div id="wrapper">
      <div class="login-wrapper">

          <div class="container">
          <div class="row">
              <div class="col-4">
                  <div class="" id="login">
                      <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                          <div class="form-group">
                            <label for="login_username">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="login_username" aria-describedby="emailHelp" name="login_username" value="">
                          </div>
                          <div class="form-group">
                            <label for="login_password">Mật khẩu</label>
                            <input type="password" class="form-control" id="login_password" name="login_password">
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="login_remember_password">
                            <label class="form-check-label" for="login_remember_password">Nhớ mật khẩu</label>
                            <a href="{{ url('admin/reset') }}" class="float-right">Quên mật khẩu</a>
                          </div>
                          <button type="submit" class="btn btn-primary w-100 mt-3">Đăng nhập</button>

                        </form>
                      </div>
              </div>
          </div>
      </div>

  </div>
  </div>
  </body>

</html>
