<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class consumer_detail extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql_yojana';
    protected $fillable = [
        'consumer_id',
        'post_id',
        'name',
        'ward_no',
        'gender',
        'cit_no',
        'issue_district',
        'contact_no',
    ];

    public function Consumer(): BelongsTo
    {
        return $this->belongsTo(consumer::class);
    }
}
