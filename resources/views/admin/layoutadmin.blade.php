<head> <meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<title> @yield('title')</title>
</head>
<body>
<div class="container">
    <nav> 
      <nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">TechChain Admin</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" href="/admin">Trang chủ</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> 
                Quản lý loại 
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/admin/loai/create">Thêm loại</a></li>
                  <li><a class="dropdown-item" href="/admin/loai">Danh sách loại</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                  Quản lý sản phẩm
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/admin/sanpham/create">Thêm sản phẩm</a></li>
                  <li><a class="dropdown-item" href="/admin/sanpham">Danh sách sản phẩm</a></li>
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
</div> 
</body>
