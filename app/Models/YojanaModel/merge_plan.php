<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class merge_plan extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = ['plan_id', 'merge_id'];

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }
}
