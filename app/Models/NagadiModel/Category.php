<?php

namespace App\Models\NagadiModel;

use App\Models\SharedModel\FiscalYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'mysql_nagadi';

    protected $table = 'categories';

    protected $fillable = [
        'has_child',
        'is_current',
        'pid',
        'name',
        'name_eng',
        'topic_number',
        'rate',
        'rate_type',
        'fiscal_year_id'
    ];
    public $timestamps = false;


    public function fiscal_year()
    {
        return $this->hasOne(FiscalYear::class, 'id','fiscal_year_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'pid','id')->with('categories');
    }


}
