<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class institutional_committee_detail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'institutional_committee_id',
        'post_id',
        'name',
        'ward_no',
        'gender',
        'cit_no',
        'issue_district',
        'mobile_no'
    ];

    public function institutionalCommittee(): BelongsTo
    {
        return $this->belongsTo(institutional_committee::class);
    }
}
