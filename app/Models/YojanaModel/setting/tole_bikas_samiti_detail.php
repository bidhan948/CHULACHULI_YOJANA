<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tole_bikas_samiti_detail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'tole_bikas_samiti_id',
        'position',
        'name',
        'ward_no',
        'gender',
        'cit_no',
        'issue_district',
        'contact_no',
    ];

    public function toleBikasSamiti(): BelongsTo
    {
        return $this->belongsTo(tole_bikas_samiti::class);
    }
}
