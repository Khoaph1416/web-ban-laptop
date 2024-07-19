<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\san_pham;
use Illuminate\Support\Str;

use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();


class AdminSPController extends Controller {
    public function index()
    {
        $perpage = env('PER_PAGE');
        $sanpham_arr = san_pham::orderBy('id','desc')
        ->paginate($perpage)->withQueryString();
        return view('admin/sanpham_ds',compact('sanpham_arr'));
    
    }
    public function create()
    {
        $loai_arr = \DB::table('loai')->orderBy('thu_tu')->get();
        return view('admin.sanpham_them',compact('loai_arr'));
    }
    public function store(Request $request)
    {
        $obj = new  san_pham;
        $obj->ten_sp = $request['ten_sp'];
        $obj->slug = Str::slug($obj->ten_sp);
        $obj->gia = (int) $request['gia'];
        $obj->gia_km = (int) $request['gia_km'];
        $obj->id_loai = (int) $request['id_loai'];
        $obj->ngay = $request['ngay'];  
        $obj->hinh = $request['hinh'];
        $obj->an_hien = $request['an_hien'];
        $obj->tinh_chat = (int) $request['tinh_chat'];
        $obj->an_hien = (int) $request['an_hien'];
        $obj->hot = (int) $request['hot'];
        $obj->mo_ta = $request['mo_ta'];   
        $obj->save();
        return redirect(route('sanpham.index'))->with('thongbao','Thêm thành công');
    
    }
    public function show(string $id)
    {
        //
    }
    public function edit( Request $request , string $id) {
        $sp = san_pham::where('id', $id)->first();
        if ($sp==null){
            $request->session()->flash('thongbao','Không có sản phẩm này: '. $id);
            return redirect('/admin/sanpham');
        }
        $loai_arr = \DB::table('loai')->orderBy('thu_tu')->get();
        return view('admin/sanpham_chinh' , compact(['sp','loai_arr']));
    }
    
    public function update(Request $request, string $id) {
        $obj = san_pham::find($id);
        $obj->ten_sp = $request['ten_sp'];
        $obj->slug = Str::slug($obj->ten_sp);     
        $obj->gia = (int) $request['gia'];
        $obj->gia_km = (int) $request['gia_km'];
        $obj->an_hien = (int) $request['an_hien'];
        $obj->hot = (int) $request['hot'];
        $obj->id_loai = (int) $request['id_loai'];
        $obj->tinh_chat = (int) $request['tinh_chat'];
        $obj->ngay = $request['ngay']; 
        $obj->hinh = $request['hinh']; 
        $obj->mo_ta = $request['mo_ta'];
        $obj->save();
        return redirect(route('sanpham.index'))->with('thongbao', 'Cập nhập thành công');
    }
    
    public function destroy(Request $request,  string $id)
    {
        $cokhong = san_pham::where('id', $id)->exists();
        if ($cokhong==false) {
            $request->session()->flash('thongbao','Sản phẩm không tồn tại');
            return redirect('/admin/sanpham');
        }
        san_pham::where('id', $id)->delete();
        $request->session()->flash('thongbao', 'Đã xóa sản phẩm');
        return redirect('/admin/sanpham');

    }
}
