<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $connection = 'mysql_shared';
    protected $table = 'setup_addr_municipalities';

    protected $fillable = [
        'did',
        'type',
        'name',
        'nep_name',
        'note'
    ];
    public $timestamps = false;
}
