<h2 class="bg-success mt-3 p-2 fs-5 text-white"> Bình luận sản phẩm</h2>
<div id="list_binh_luan">
@foreach($binh_luan_arr as $bl)
<div class="border border-success m-2 p-2">
    <p class="d-flex justify-content-between">
      <b>{{$bl->user->name}}</b> 
      <span>{{ gmdate('d/m/Y H:m:s', strtotime($bl->thoi_diem)+3600*7)}}</span>
    </p>
    <p>{{$bl->noi_dung}}</p>
</div>
@endforeach
</div>
<hr>
<form class="border border-success p-3" method="post" action="/luubinhluan">
<p>
<textarea class="form-control shadow-none fs-5" 
name="noi_dung" rows="4" placeholder="Mời nhập bình luận"></textarea>
</p>
<p class="text-end"> @csrf  
  <input type="hidden" name="id_sp" value="{{$sp->id}}">
  <button class="btn btn-success " type="submit"> Gửi bình luận</button>
<p>
</form>
