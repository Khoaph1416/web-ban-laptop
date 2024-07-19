<h1 class="bg-dark p-2 fs-5 text-white"> 
   {{ $ten_loai }}
</h1>
<div id="data" class="d-flex flex-wrap">
    @foreach($sptrongloai_arr as $sp)
    <div class="col-md-4">
        <div class="border border-primary m-1 p-2 text-center">
            <h3 class="fs-5">
                <a href="/sp/{{$sp->id}}" class="text-decoration-none">{{$sp->ten_sp}}</a>
            </h3>
            <img src="{{$sp->hinh}}" class="border shadow-sm" style="height:200px; width: 90%"> 
            <del class='fw-bolder m-2 fs-5' >
                {{ number_format( $sp->gia , 0 , "," , ".") }} VNĐ 
                </del>
                <div class='fw-bolder m-2 fs-5' >
                    {{ number_format( $sp->gia_km , 0 , "," , ".") }} VNĐ 
                    </div>
                <a href="/themvaogio/{{$sp->id}}" class='btn btn-primary px-3'>Thêm vào giỏ hàng</a>
        </div>
    </div>
    @endforeach
</div>
<div class="p-2 d-flex justify-content-center">{{$sptrongloai_arr->links() }}</div>
