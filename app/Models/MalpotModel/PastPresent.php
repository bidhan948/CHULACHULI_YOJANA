<?php

namespace App\Models\MalpotModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPresent extends Model
{
    use HasFactory;
    protected $connection = 'mysql_malpot';

    protected $table = 'settings_past_present';

    protected $fillable = [
        'old_ward',
        'old_vdc_mp',
        'new_ward',
        'new_vdc_mp',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
