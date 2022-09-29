<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class anugaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';
    protected $fillable = ['anugamanable_id', 'anugamanable_type', 'plan_id'];

    public function anugamanable() : MorphTo
    {
        return $this->morphTo();
    }
}
