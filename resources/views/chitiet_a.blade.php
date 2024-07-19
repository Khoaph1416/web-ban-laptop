<div id='chitietsp' class="d-flex">
    <div class="col-md-6"> 
        <img src="{{$sp->hinh}}" class="col-9 m-auto" alt="{{ $sp->ten_sp }}" title="Hình sản phẩm{{ $sp->ten_sp }}"> 
    </div>
    <div class="col-md-6 p-2 fs-5"> 
      <h1 class="h3 mt-0 mb-2"> {{ $sp->ten_sp }} </h1>
      <div class="mb-3">
        <span>Giá chính</span> : <del>{{number_format($sp->gia,0,',','.')}}</del> VNĐ
      </div>
      <div class="mb-3">
        <span>Khuyến mãi</span>: {{number_format($sp->gia_km,0, ',','.')}} VNĐ
      </div>
      <div class="mb-3">
        <span>Ngày cập nhật</span>: {{date('d/m/Y', strtotime($sp->ngay))}}
      </div>
      <div class="mb-3">
        <span>Số lượng</span>:  
        <input class="w-25 p-0 shadow-none text-center fs-6" type="number" id="soluong" min="1" max="50" value="1" >
     </div>
     <div>
     <a class='btn btn-primary' href="/themvaogio/{{$sp->id}}">Thêm vào giỏ</a> 
     <button onclick='history.back()' class='btn btn-success px-4'>Trở lại</button>
     </div> 
    </div>
</div>
