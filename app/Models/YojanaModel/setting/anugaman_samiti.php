<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class anugaman_samiti extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'ward_no', 'anugaman_samiti_type_id','is_useable'];

    protected $connection = 'mysql_yojana';

    public function anugamanSamitiDetails(): HasMany
    {
        return $this->hasMany(anugaman_samiti_detail::class);
    }
}
