<?php

namespace App\Models\YojanaModel;

use App\Models\YojanaModel\setting\anugaman_samiti;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class anugaman_plan extends Model
{
    use HasFactory;

    protected $fillable = ['plan_id', 'anugaman_samiti_id', 'type_id'];
    protected $connection = 'mysql_yojana';

    public function anugamanSamiti(): BelongsTo
    {
        return $this->belongsTo(anugaman_samiti::class);
    }
    
}
