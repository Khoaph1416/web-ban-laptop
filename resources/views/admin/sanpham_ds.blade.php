@extends('admin/layoutadmin')
@section('title') Danh sách sản phẩm  @endsection
@section('noidungchinh')
@if(session()->has('thongbao'))
    <div class="alert alert-danger p-3 mx-auto my-3 col-10 fs-5  text-center">
        {!! session('thongbao') !!}
    </div>
@endif
<table class="table table-bordered m-auto" id="dssanpham">
    <caption align="top" class="bg-warning fw-bolder">DANH SÁCH SẢN PHẨM</caption>
    <tr><th>Hình</th> <th>Tên sản phẩm </th> <th>Giá</th>
        <th>Ngày</th> <th>Trạng thái</th> <th>Sửa Xóa</th>
    </tr>
    @foreach($sanpham_arr as $sp)
    <tr><td><img src="{{$sp->hinh}}" width="120" height="80"></td>   
        <td><b>{{$sp->ten_sp}}</b> <br> Lượt xem: {{$sp->luot_xem}}
        </td>
        <td>Giá:{{ number_format($sp->gia,0,',', '.') }} <br>
            KM :  {{ number_format($sp->gia_km,0,',', '.') }}
        </td>
        <td> {{date('d/m/ Y',strtotime($sp->ngay))}}</td>
        <td> Ẩn hiện: {{($sp->an_hien==0)? "Đang ẩn":"Đang hiện"}} <br>
             Nổi bật: {{($sp->hot==0)? "Bình thường":"Nổi bật"}} 
        </td>
        <td> 
        <a class="btn btn-primary btn-sm" href="{{route('sanpham.edit', $sp->id)}}">Sửa</a>       
        <form class="d-inline" action="{{ route('sanpham.destroy', $sp->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type='submit' onclick="return confirm('Xóa hả')" class="btn btn-danger btn-sm">
            Xóa
            </button>
        </form>
     
       </td>
    </tr>
    @endforeach
    <tr> <td colspan="6"> {{ $sanpham_arr->links() }} </div> </td> </tr>
</table>
@endsection
