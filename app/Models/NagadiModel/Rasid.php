<?php

namespace App\Models\NagadiModel;

use App\Models\SharedModel\FiscalYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rasid extends Model
{
    use HasFactory;
    protected $connection = 'mysql_nagadi';

    protected $table = 'rasids';

    protected $fillable = [
        'fiscal_year_id',
        'date_nep',
        'date_eng',
        'customer_name',
        'pan_no',
        'bill_no',
        'provience',
        'district',
        'gapa_napa',
        'ward',
        'grand_total',
        'recieved_amount',
        'return_amount',
        'status',
        'payment_mode',
        'bank',
        'cheque_number',
        'cancel_reason',
        'cancel_date_nep',
        'cancel_date_eng',
        'created_by',
        'updated_by',
    ];

    public function setDateNepAttribute($value)
    {
        $this->attributes['date_nep'] = $value;
        $this->attributes['date_eng'] = convertBsToAd($value);
    }

    public function rasid_details() {
        return $this->hasMany(RasidDetail::class, 'id', 'rasid_id');
    }

    public function fiscal_year()
    {
        return $this->hasOne(FiscalYear::class, 'id','fiscal_year_id');
    }
}
