<?php

namespace App\Models\NagadiModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasidDetail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_nagadi';

    protected $table = 'rasid_details';

    protected $fillable = [
        'main_sirsak',
        'upa_sirsak',
        'sirsak',
        'anya_sirsak',
        'parimad',
        'rate',
        'rate_type',
        'total',
        'rasid_id'
    ];

    public $timestamps = false;

    public function main_sirsak()
    {
        return $this->hasOne(Category::class, 'id','main_sirsak');
    }
    public function rasid()
    {
        return $this->belongsTo(Rasid::class, 'rasid_id');
    }
}
