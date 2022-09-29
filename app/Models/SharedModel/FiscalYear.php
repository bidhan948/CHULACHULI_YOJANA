<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;

    protected $connection = 'mysql_shared';
    protected $table = 'fiscal_years';

    protected $fillable = [
        'name',
        'is_current'
    ];
    public $timestamps = false;

    public function scopeCurrentFiscalYear($query)
    {
        return $query->where('is_current',1)->get();
    }
    
    public function scopeExceptFiscalYear($query)
    {
        return $query->where('is_current',0)->get();
    }
}
