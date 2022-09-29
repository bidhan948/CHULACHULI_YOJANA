<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class anugaman_samiti_detail extends Model
{
    use HasFactory;

    protected $fillable = ['anugaman_samiti_id', 'name', 'post_id','ward_no','mobile_no','gender','status'];

    protected $connection = 'mysql_yojana';
    
    public function anugamanSamiti(): BelongsTo
    {
        return $this->belongsTo(anugaman_samiti::class);
    }
}
