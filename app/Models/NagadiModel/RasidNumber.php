<?php

namespace App\Models\NagadiModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasidNumber extends Model
{
    use HasFactory;
    protected $connection = 'mysql_nagadi';

    protected $table = 'rasid_numbers';

    protected $fillable = [
        'user_id',
        'from_rasid_number',
        'to_rasid_number',
        'transfered_from',
        'transfered_to',
        'fiscal_year_id',
        'created_by',
        'updated_by',
        'is_cancelled',
        'cancellation_reason'
    ];
}
