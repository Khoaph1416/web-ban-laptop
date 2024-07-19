<div id="splienquan">
    <h2 class="bg-success p-2 fs-5 text-white"> Sản phẩm liên quan</h2>
    <div id="data" class="d-flex flex-wrap">
    @foreach($splienquan_arr as $sp)
    <div class="col-md-3">
        <div class="border border-primary m-1 p-2 text-center">
            <h3 class="fs-6" style="height: 35px">
              <a href="/sp/{{$sp->id}}" class="text-decoration-none"> {{$sp->ten_sp}} </a>
            </h3>
            <img src="{{$sp->hinh}}" class="border shadow-sm" style="height:150px; width: 90%"> 
            <del class='fw-bolder m-2 fs-5' >
                {{ number_format( $sp->gia , 0 , "," , ".") }} VNĐ 
                </del>
                <div class='fw-bolder m-2 fs-5' >
                    {{ number_format( $sp->gia_km , 0 , "," , ".") }} VNĐ 
                    </div>
                <a href="/themvaogio/{{$sp->id}}" class='btn btn-primary px-3'>Thêm vào giỏ hàng</a>n>
        </div>
    </div>
    @endforeach
</div>
</div>
