<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $connection = 'mysql_shared';
    protected $table = 'setup_addr_districts';

    protected $fillable = [
        'pid',
        'name',
        'nep_name',
        'note'
    ];
    public $timestamps = false;
}
