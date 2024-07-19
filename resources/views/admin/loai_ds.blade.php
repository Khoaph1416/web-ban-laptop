@extends('admin/layoutadmin')
@section('title') Danh sách loại sản phẩm  @endsection
@section('noidungchinh')
   <h2 class="p-2 fs-4 bg-info-subtle mb-0">Danh sách loại sản phẩm</h2>
    @if(session()->has('thongbao'))
        <div class="alert alert-danger p-3 mx-auto my-3 col-10 fs-5  text-center">
            {!! session('thongbao') !!}
        </div>
    @endif
   <table class="table table-bordered border border-primary">
    <tr class="text-center">
       <th>id</th> <th>Tên loại</th> <th>Slug</th> <th>Thứ tự</th> <th>Ẩn hiện </th> <th></th>
    </tr>
    @foreach ($loai_arr as $loai)
    <tr class="text-center">
        <td>{{$loai->id}}</td>
        <td>{{$loai->ten_loai}}</td>
        <td>{{$loai->slug}}</td>
        <td>{{$loai->thu_tu}}</td>
        <td>{{$loai->an_hien==1? "Đang hiện":"Đang ẫn"}}</td>       
        <td class="text-end"> 
            <a class="btn btn-primary btn-sm" href="{{url('admin/loai/'.$loai->id.'/edit')}}" >Chỉnh</a> 
            <form class="d-inline" action="{{route('loai.destroy', $loai->id)}}" method="POST">
                @csrf  @method('DELETE')
                <button type='submit' onclick="return confirm('Bạn muốn xóa à')" 
                class="btn btn-danger btn-sm ms-1" >Xóa</button>
            </form>
 
        </td>
    </tr>
    @endforeach
    </table>
    <div class="text-center p-2">{{$loai_arr->links()}}</div>
@endsection
