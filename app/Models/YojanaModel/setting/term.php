<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class term extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';
    protected $fillable = ['added_by', 'modified_by', 'type_id', 'term'];

    // over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->added_by = auth()->id();
        });
    }
}
