<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class binh_luan extends Model {
    use HasFactory;
    protected $table = 'binh_luan';
    public $primaryKey = 'id';
    protected $attributes = [];
    public $timestamps = true;
    protected $dates = ['thoi_diem'];
    protected $fillable = ['id_sp', 'id_user','noi_dung','thoi_diem','an_hien'];
    public function san_pham(): BelongsTo {
        return $this->belongsTo(san_pham::class, 'id_sp');
    }
    public function User(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user');
    }
}
