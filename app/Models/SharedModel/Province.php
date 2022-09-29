<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $connection = 'mysql_shared';
    protected $table = 'setup_addr_provinces';

    protected $fillable = [
        'name',
        'nep_name',
        'note',
    ];
    public $timestamps = false;
}
