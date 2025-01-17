<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\loai;
use Illuminate\Support\Str;

use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class AdminLoaiController extends Controller {
    public function index()
    {
        $perPage = env('PER_PAGE')/2;
        $loai_arr = loai::orderBy('thu_tu', 'asc')->paginate($perPage)->withQueryString();      
        return view('admin/loai_ds', compact('loai_arr'));
     
    }
    public function create()
    {
        return view('admin.loai_them');
    }
    public function store(Request $request)
    {
        $obj = new loai;
        $obj->ten_loai = ucfirst($request['ten_loai']);
        $obj->an_hien = $request['an_hien'];
        $obj->thu_tu = $request['thu_tu'];
        $obj->slug = Str::slug($obj->ten_loai);
        $obj->save();
        return redirect(route('loai.index'))->with('thongbao', 'Thêm thành công');
    
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $loaisp = loai::find($id);
        return view('admin.loai_chinh', compact('loaisp'));
    
    }
    public function update(Request $request, string $id)
    {
        $obj = loai::find($id);
        $obj->ten_loai = $request['ten_loai'];
        $obj->thu_tu = $request['thu_tu'];
        $obj->an_hien = $request['an_hien'];
        $obj->slug = Str::slug($obj->ten_loai);
        $obj->save();
        return redirect(route('loai.index'))->with('thongbao', 'Cập nhập thành công');
    
    }
    public function destroy(string $id)
    {
        $dem_sp = \DB::table('san_pham')->where('id_loai', $id)->count();
        if($dem_sp > 0){
            return redirect(route('loai.index'))->with('thongbao', 'Không thể xóa mục này!');
        }
        $loaisp = loai::find($id);
        $loaisp->delete();
        return redirect(route('loai.index'))->with('thongbao', 'Xóa thành công');
    
    }
}
