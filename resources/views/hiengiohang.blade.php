@extends('layout')
@section('title') Giỏ hàng của bạn @endsection
@section('noidungchinh')
<div class="container">
          @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
        @endif

        <table class="table table-bordered align-middle border-primary m-2" id="tblgiohang">
        <caption class="fw-bolder text-center fs-4" align="top">
          SẢN PHẨM BẠN ĐÃ CHỌN 
        </caption>
        <tr>
              <thead class="text-center">
                <th>Tên sản phẩm</th> 
              <th>Số lượng </th>
                <th>Đơn giá</th> 
                <th>Thành tiền</th> 
                <th>Xóa</th>
              </thead>
        </tr>   
        @if (empty($cart))
        <tr>
            <td colspan="5" class="text-center">Giỏ hàng rỗng</td>
        </tr>
        @else
        @foreach( $cart as $c ) 
        <tr>
            <td class=""><b>{{$c['ten_sp']}}</b> </td>
            <td><input type='number' value="{{$c['soluong']}}" class='form-control m-auto w-75 border-border-secondary shadow-none'></td>
            <td class="text-end"> {{number_format($c['gia'] , 0, ',' , '.' )}} VNĐ</td>
            <td class="text-end"> {{number_format($c['thanhtien'], 0 , ',' , '.') }} VNĐ</td>
            <td class="text-center"> 
                <a href="/xoasptronggio/{{$c['id_sp']}}">Xóa</a> 
            </td>
        </tr> 
        @endforeach
        <tr> <th colspan="5" class='text-center'>
          Số sản phẩm {{$tongsoluong}} . Tổng tiền {{number_format($tongtien, 0,',','.')}} VNĐ
        </th>
        </tr>
        </table>
        <form method="POST"> @csrf
        <label for="">Họ tên:</label>
        <input type="text" name="hoten" required>
        <label for="">Số điện thoại:</label>
        <input type="text" name="dt" required>
        <label for="">Địa chỉ nhận hàng:</label>
        <input type="text" name="dc" required>
        <button type="submit"  onclick="return confirm('Bạn có chắc là muốn đặt hàng chưa!')">Đặt hàng</button>
        </form>
        @endif
</div>

@endsection

