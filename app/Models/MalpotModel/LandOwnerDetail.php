<?php

namespace App\Models\MalpotModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandOwnerDetail extends Model
{
    use HasFactory;
    protected $connection = 'mysql_malpot';

    protected $table = 'land_owner_details';

    protected $fillable = [
        'sn',
        'number',
        'first_letter_number',
        'land_ownership_type',
        'single_ownership_type',
        'organization_type',
        'land_ward_no',
        'house_number',
        'other_details',
        'permanent_province',
        'permanent_district',
        'permanent_municipality',
        'permanent_ward',
        'permanent_tole',
        'temprorary_province',
        'temprorary_district',
        'temprorary_municipality',
        'temprorary_ward',
        'temprorary_tole',
        'contact_name',
        'contact_name_english',
        'contact_number',
        'contact_email',
        'pan_number',
        'dakhila_date_nep',
        'dakhila_date_eng',
        'dakhila_province',
        'dakhila_district',
        'dakhila_municipality',
        'dakhila_ward',
        'dakhila_relation',
        'dakhila_name',
        'status'
    ];


    public function land_owner_personal_detail()
    {
        return $this->hasMany(LandOwnerPersonelDetail::class, 'land_owner_detail_id');
    }
}
