<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();
use Illuminate\Support\Arr;
use App\Models\binh_luan;
use App\Models\don_hang;
use App\Models\don_hang_chi_tiet;
use App\Models\User;
use App\Models\san_pham;
use Illuminate\Support\Facades\Auth;

class SanphamController extends Controller
{
    public function __construct() {
        $loai_arr = DB::table('loai')->where('an_hien',1 )->orderBy('thu_tu')->get();
        \View::share( 'loai_arr', $loai_arr  );
    }   
    function index(){
       $spnoibat_arr = DB::table('san_pham')
       ->where('an_hien', 1)
       ->where('hot',1)
       ->orderBy('ngay','desc')
       ->limit(9)->get();
       
       $spgiamsoc_arr = DB::table('san_pham')
        ->where('an_hien', 1)
        ->where('tinh_chat', 2)
        ->orderBy('ngay','desc')
        ->limit(9)->get();  

        return view ('home' , compact(['spnoibat_arr','spgiamsoc_arr']));

    }
    function chitiet($id = 0){
        $sp = DB::table('san_pham')->where ('id','=', $id)->first();   
        if($sp==null) return redirect('/thongbao')->with(['thongbao'=>'Không có sản phẩm này']);
      
        $splienquan_arr = DB::table('san_pham')->where('id_loai', $sp->id_loai)
        ->where('tinh_chat', $sp->tinh_chat)->orderBy('ngay','desc')
        ->limit(4)->get()->except($id);  
          $binh_luan_arr = binh_luan::where('id_sp', $id)->orderBy('thoi_diem','asc')->get();
          return view('chitiet',compact(['sp', 'splienquan_arr', 'binh_luan_arr']));
      }
    
    
    function sptrongloai($id_loai = 0){
        //return view ('sptrongloai', ['id'=>$idloai]);
        $per_page= env('PER_PAGE'); //9
        $sptrongloai_arr = DB::table('san_pham')
        ->where ('id_loai', $id_loai)
        ->paginate($per_page)->withQueryString();
        $ten_loai = DB::table('loai')->where ('id', $id_loai)->value('ten_loai');
        return view ('sptrongloai', compact(['id_loai', 'ten_loai', 'sptrongloai_arr']));
    }
    function luubinhluan(){
        $id_user=1;
        $arr = request()->post(); 
        $id_sp = (Arr::exists($arr, 'id_sp'))? $arr['id_sp']:"-1";
        $noi_dung = (Arr::exists($arr, 'noi_dung'))? $arr['noi_dung']:"";
        if ($id_sp<=-1) return redirect("/thongbao")->with(['thongbao'=>"Không biết sản phẩm $id_sp"]);
        if ($noi_dung=="") return redirect("/thongbao")->with(['thongbao'=>'Nội dung không có']);
        binh_luan::insert(
          ['id_user'=>$id_user, 'id_sp'=>$id_sp, 'noi_dung'=>$noi_dung, 'thoi_diem'=>now()]
        );
        //return redirect('/thongbao')->with(['thongbao'=>'Đã lưu bình luận']);
        return redirect("/sp/$id_sp");
    }  
   public function themvaogio(Request $request, $id_sp = 0, $soluong=1){
        if ($request->session()->exists('cart')==false) {//chưa có cart trong session           
            $request->session()->push('cart', ['id_sp'=> $id_sp,  'soluong'=> $soluong]);          
        } else {// đã có cart, kiểm tra id_sp có trong cart không
            $cart =  $request->session()->get('cart'); 
            $index = array_search($id_sp, array_column($cart, 'id_sp')); //1
            if ($index!=''){ //id_sp có trong giỏ hàng thì tăhg số lượng
                $cart[$index]['soluong']+=$soluong;
                $request->session()->put('cart', $cart);
            }
            else { //sp chưa có trong arrary cart thì thêm vào 
                $cart[]= ['id_sp'=> $id_sp, 'soluong'=> $soluong];
                $request->session()->put('cart', $cart);
            }    
        }  return back();     
    }
   public function hiengiohang(Request $request){
        $cart =  $request->session()->get('cart'); 
        if (empty($cart)) {
            return view('hiengiohang', [
                'cart' => [],
                'tongsoluong' => 0,
                'tongtien' => 0,
                'message' => 'Giỏ hàng rỗng'
            ]);
        }
        $tongtien = 0;   
        $tongsoluong=0;
        for ( $i=0; $i<count($cart) ; $i++) {
          $sp = $cart[$i]; // $sp = [ 'id_sp' =>100, 'soluong'=>4, ]
          $ten_sp = DB::table('san_pham')->where('id', $sp['id_sp'] )->value('ten_sp');
          $gia_km = DB::table('san_pham')->where('id', $sp['id_sp'] )->value('gia_km');
          $hinh = DB::table('san_pham')->where('id', $sp['id_sp'] )->value('hinh');
          $thanhtien = $gia_km*$sp['soluong'];
          $tongsoluong+=$sp['soluong'];
          $tongtien += $thanhtien;

          $sp['ten_sp'] = $ten_sp;
          $sp['gia'] = $gia_km;
          $sp['hinh'] = $hinh;
          $sp['thanhtien'] = $thanhtien;
          $cart[$i] = $sp;
        }
        $request->session()->put('cart', $cart);
        return view('hiengiohang', compact(['cart', 'tongsoluong','tongtien']));
      }
   public function xoasptronggio(Request $request, $id =0){
        $cart =  $request->session()->get('cart'); 
        $index = array_search($id, array_column($cart, 'id_sp'));
        if ($index!=''){ 
            array_splice($cart, $index, 1);
            $request->session()->put('cart', $cart);
        }
        return redirect('/hiengiohang');
    }
    public function thanhtoan(Request $request){
        $cart = $request->session()->get('cart');

    if (!$cart) {
        return redirect('/hiengiohang')->with('error', 'Giỏ hàng rỗng!');
    }else{
        $donhang = new don_hang();
        $donhang->id_user= (Auth::check()) ? Auth::user()->id : null;
        $donhang->ten_nguoi_nhan = $request->hoten;
        $donhang->dien_thoai = $request->dt;
        $donhang->dia_chi_giao = $request->dc;
        $donhang->tong_tien =0;
        $donhang->tong_so_luong =0;
        $donhang->save();

        foreach ($cart as $c) {
            $dhct = new don_hang_chi_tiet();
            $dhct->id_dh = $donhang->id;
            $dhct->id_sp = $c['id_sp'];
            $dhct->so_luong = $c['soluong'];
            $dhct->gia = $c['gia'];
            $dhct->save();

            $donhang->tong_tien += $dhct->so_luong * $dhct->gia;
            $donhang->tong_so_luong += $dhct->so_luong;
        }
        $donhang->save();
        $request->session()->forget('cart');

        return redirect('/hiengiohang')->with('success', 'Đặt hàng thành công!!');
    }
    }
    
}
