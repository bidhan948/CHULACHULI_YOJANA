<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class type extends Model
{
    use HasFactory;
    
    const NAMESPACE_TOLE_BIKAS_SAMITI = 'App\Models\YojanaModel\setting\tole_bikas_samiti';
    
    protected $fillable = ['typeable_id','typeable_type','plan_id','fiscal_year_id'];

    protected $connection = 'mysql_yojana';
    
    public function typeable() : MorphTo
    {
        return $this->morphTo();
    }
}
