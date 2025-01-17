<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <link href="/css/style.css" rel="stylesheet">
    @stack('css')
    @stack('javascript1')
</head>
<body>

<header class='bg-dark'>
    <img src="/images/logo.png"  width="60px">
    <h1 class="text-light">Laptopshop.com</h1>
    <a id="giohang"  href="/hiengiohang" >Xem giỏ hàng</a>
</header>
<nav class="bg-warning d-flex align-items-center justify-content-center">
<nav class="navbar navbar-expand-lg bg-warning fw-bolder" data-bs-theme="dark" >
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Techchain</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Trang chủ</a>
        </li>
        @foreach( $loai_arr as $lt)
        <li class="nav-item">
          <a class="nav-link" href="/loai/{{$lt->id}}">{{$lt->ten_loai}}</a>
        </li>
        @endforeach
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tài khoản
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Đăng nhập</a></li>
            <li><a class="dropdown-item" href="#">Đăng ký</a></li>
            <li><a class="dropdown-item" href="#">Đổi pass</a></li>
            <li><a class="dropdown-item" href="#">Quên pass</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

</nav>

<main>
   @yield('noidungchinh')   
</main>

<footer class="bg-dark text-white py-4">
  <div class="container">
      <div class="row">
          <div class="col-md-4">
              <h5>Thông Tin Liên Hệ</h5>
              <p>Địa chỉ: 134 Công Viên Phầm Mềm Quang Trung</p>
              <p>Điện thoại: 09**********</p>
              <p>Email: info@shoplaptop.com</p>
          </div>
          <div class="col-md-4">
              <h5>Chính Sách</h5>
              <ul class="list-unstyled">
                  <li><a href="#" class="text-white">Chính sách bảo hành</a></li>
                  <li><a href="#" class="text-white">Chính sách đổi trả</a></li>
                  <li><a href="#" class="text-white">Chính sách bảo mật</a></li>
              </ul>
          </div>
          <div class="col-md-4">
              <h5>Mạng Xã Hội</h5>
              <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="text-white me-2"><img src="/images/Instagram.jpg" width="70px" alt=""></i></a>
              <a href="#" class="text-white"><img src="/images/facebook.jpg" width="70px"></a>
          </div>
      </div>
  </div>
</footer>

</body>
</html>
@stack('javascript2')
