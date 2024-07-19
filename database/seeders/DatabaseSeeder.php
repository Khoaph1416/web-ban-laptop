<?php
namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Arr; //array helper
use Illuminate\Support\Str; //string helper

class DatabaseSeeder extends Seeder {
    public function run(): void  {
        //chèn bảng users
        DB::table('users')->insert([
            [ 'name' => 'Đỗ Đạt Cao', 'password' => bcrypt('hehe') , 'dia_chi'=>'',
                'email' => 'dodatcao@gmail.com','dien_thoai' => '0918765238',
                'hinh' => '','role' => 1 ], 
            [ 'name' => 'Mai Anh Tới', 'password' => bcrypt('hehe') ,'dia_chi'=>'',
                'email' => 'maianhtoi@gmail.com','dien_thoai' => '098532482',
                'hinh' => '','role' => 0 ],
            [ 'name' => 'Đào Kho Báu', 'password' => bcrypt('hehe') ,'dia_chi'=>'',
                'email' => 'daokhobau@gmail.com','dien_thoai' => '097397392',
                'hinh' => '','role' => 1]
        ]);
        //chèn bảng loai
        $loai_arr = ['Asus', 'Acer','Lenovo','MSI','HP','Dell','Apple','Surface','Masstel','LG','CHUWI','itel'];
        for ($i=0; $i<count($loai_arr); $i++){
            DB::table('loai')->insert(
                ['ten_loai' => $loai_arr[$i], 'thu_tu' => $i ,'an_hien' => 1]
            );
        };
        //chèn bảng sản phẩm và thuộc tính
        $ten2_arr = [ 
            'Gaming ROG Strix',
            'Nitro 5 Gaming',
            'Ideapad Gaming 3',
            'Gaming GF63 Thin',
            'Gaming G15',
            'MacBook Pro',
            'Pro 9',
            'E140',
            'E116',
            'gram 2023',
            'CoreBook',
            'LarkBook',
            'ABLE',
            'Spirit',
            'ROG Strix',
            'Vivobook',
            'Zenbook',
            'Pavilion'];
        $ten3_arr = [ 
            'G15 G513IH',
            'AN515 45 R6EV',
            '15IHU6',
            '11SC',
            'Gaming VICTUS',
            'fa0111TX i5',
            '5511 11400H',
            'M2 2022',
            '1255U',
            'N4120',
            'N4020',
            '1360P',            
            'X 8259U',
            'X N5100',
            '1S N4020',
            '1155G7',
            'G15 G513IH',
            '15 X1502ZA i5',
            '14 OLED UX3402ZA',
            '15 eg2082TU'];
        $hinh_arr = [
        'https://cdn.tgdd.vn/Products/Images/44/270031/asus-rog-strix-gaming-g513ih-r7-hn015w-2-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/263980/Slider/vi-vn-acer-nitro-5-gaming-an515-45-r6ev-r5-nhqbmsv006-4.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/302226/lenovo-ideapad-gaming-3-15ihu6-i5-82k101f3vn-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/302486/hp-victus-15-fa0111tx-i5-7c0r4pa-glr-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/264354/dell-gaming-g15-5511-i5-70266676-1-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/282828/apple-macbook-pro-13-inch-m2-2022-231122-041529.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/302951/masstel-e140-n4120-glr-2.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/302950/masstel-e116-n4020-glr-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/306795/lg-gram-2023-i7-17z90rgah78a5-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/270142/chuwi-corebook-x-i5-8259u-1-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/270141/chuwi-larkbook-x-n5100-2-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/265523/itel-able-1s-n4020-71006300027-1-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/300000/itel-spirit-2-i5-71006300202-3.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/270031/asus-rog-strix-gaming-g513ih-r7-hn015w-2-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/281483/asus-vivobook-15-x1502za-i5-ej120w-1-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/284258/asus-zenbook-14-oled-ux3402za-i5-km218w-a-1.jpg',
        'https://cdn.tgdd.vn/Products/Images/44/302533/hp-pavilion-15-eg2082tu-i5-7c0q5pa-1.jpg'];

        $loaiSP_arr = DB::table('loai')->pluck( 'ten_loai', 'id',); /*  id là key, ten_loai là value
            1 => "Asus"
            2 => "Acer"   */
        $ram_arr = ['4GB', '8GB', '16GB','32GB'];
        $dia_arr = ['256GB', '512GB', '1TB'];
        $mau_arr = ['Đen', 'Xám', 'Trắng','Bạc','Đỏ'];
        $cannang_arr = ['1.0','1.2', '1.4', '1.6','1.8','2.0','2.3','2.5'];
        $cpu_arr = ['i3', 'i5', 'i7'];
        for ($i=1; $i<=5000; $i++){
            $gia = mt_rand(5000000, 30000000);
            $gia_km = $gia - mt_rand(1000000, 5000000);
            $tinh_chat = 0 ;// 0 bình thường, 1 giá rẻ, 2 giảm sốc, 3 cao cấp
            if ($gia >= 28000000) $tinhchat = 3;  //cao cấp
            else if ($gia - $gia_km >= 3000000) $tinh_chat = 2; //giảm sốc
            else if ($gia<=6000000) $tinh_chat = 1;//giá rẻ
            else $tinhchat = 0; //bình thường
            $randtime = mt_rand(2022, 2024).'-'. mt_rand(1,12) .'-'. mt_rand(1,28) ." 23:59:59";
            $id_loai = mt_rand(1, count($loaiSP_arr)); ///  1- 12
            $ten_loai = $loaiSP_arr[$id_loai];
            $ten_sp = $ten_loai . ' '. Arr::random($ten2_arr) . ' '. Arr::random($ten3_arr);
            $id = DB::table('san_pham')->insertGetId([
                'ten_sp' =>  $ten_sp, 
                'id_loai' => $id_loai,
                'hinh' => Arr::random($hinh_arr) ,
                'gia' => $gia, 
                'gia_km' => $gia_km, 
                'hot'=> (Arr::random([0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]) %3==0)?1:0,
                'ngay' => $randtime ,
                'an_hien'=>(Arr::random([0,1,2,3,4,5,6,7,8,9,10]) %8==0)?0:1, 
                'luot_xem'=> mt_rand(0, 1000),
                'tinh_chat'=> $tinh_chat
            ]);
            $slug = Str::slug($ten_sp) . "-". $id;
            DB::table('san_pham')->where('id', $id)->update(['slug'=> $slug]);
            
            DB::table('thuoc_tinh')->insert([
                'id_sp' => $id ,
                'ram' => Arr::random($ram_arr) ,
                'cpu' =>Arr::random($cpu_arr),
                'dia_cung' => Arr::random($dia_arr),
                'mau_sac' => Arr::random($mau_arr),
                'can_nang'=> Arr::random($cannang_arr)
            ]);
        }//for

    }//run
} //class
