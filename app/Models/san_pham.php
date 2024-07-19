<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class san_pham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';
    public $primaryKey = 'id';
    protected $attributes = [];
    protected $dates = ['ngay'];
    protected $fillable = ['ten_sp', 'slug','gia','gia_km','id_loai',
            'ngay', 'hinh','hot','luot_xem','an_hien','tinh_chat','mo_ta'];

    //bên 1 cần có 1 hàm mang tên bên nhiều
    public function binh_luan(): HasMany {
        return $this->hasMany(binh_luan::class);
    }
}
