<?php

use App\Helpers\NepaliCalender;
use App\Models\SharedModel\FiscalYear;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use App\Models\YojanaModel\kul_lagat;


/***************  function to convert English numbers into Nepali **********************/
function Nepali($num)
{
    $num_nepali = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
    $num_eng = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $nums = str_replace($num_eng, $num_nepali, $num);
    return $nums;
}
/***************  function to convert English numbers into Nepali **********************/
function NepaliAmount($num)
{
    $num_nepali = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
    $num_eng = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($num_eng, $num_nepali, preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $num));
}

/***************  function to convert nepali numbers into english **********************/

function English($num)
{
    $num_nepali = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
    $num_eng = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $nums = str_replace($num_nepali, $num_eng, $num);
    return $nums;
}
/***************  function to convert nepali numbers into english **********************/

function RateType($num)
{
    $type = "";
    switch ($num) {
        case 100:
            $type = "प्रतिसत";
            break;

        case 1000:
            $type = "प्रति हजार";
            break;
        case 100000:
            $type = "प्रति लाख";
            break;
        case 10000000:
            $type = "प्रति करोड";
            break;
        default:
            $type = "(रु)";
            break;
    }
    return $type;
}



function convertBsToAd($date)
{
    return NepaliCalender::getInstance()->BsToAd($date);
}

function convertAdToBs($date)
{
    return NepaliCalender::getInstance()->AdToBs($date);
}

function getCurrentFiscalYear($obj = false)
{
    $fiscal = FiscalYear::query()
        ->CurrentFiscalYear()
        ->first();

    return $obj ? $fiscal : ($fiscal == null ? '2078/2079' : $fiscal->name);
}

/**
 **  @return ORM COLLECTION
 */

function getSettingByKey(array $array = [])
{
    foreach ($array as $key => $value) {

        $returnKey = str_replace('-', '_', $value) . "s"; //making value as a reusable key
        $data[$returnKey] = Setting::query()
            ->slug($value)
            ->with('settingValues')
            ->updatedIn(session('active_app'))
            ->first();
    }

    return collect($data);
}

function getSettingValueById($id = null)
{
    $value = SettingValue::query()->where('id', $id)->first();
    $dataObj = new \stdClass();
    $dataObj->name = '';
    return $value == null ? $dataObj : $value;
}

/**
 **  @return ORM COLLECTION
 */

function getAmountIncContingency(int $plan_id)
{
    $data = [];
    $kul_lagat = kul_lagat::query()->where('plan_id', $plan_id)->first();

    if ($kul_lagat != null) {
        $data['napa_amount'] = $kul_lagat->napa_contingency == null  ? $kul_lagat->napa_amount : ($kul_lagat->napa_amount) * (1 - ($kul_lagat->napa_contingency / 100));
        $data['other_office_con'] = $kul_lagat->other_office_con_contingency == null  ? $kul_lagat->other_office_con : ($kul_lagat->other_office_con) * (1 - ($kul_lagat->other_office_con_contingency / 100));
        $data['other_office_agreement'] = $kul_lagat->other_agreement_contingency == null  ? $kul_lagat->other_office_agreement : ($kul_lagat->other_office_agreement) * (1 - ($kul_lagat->other_agreement_contingency / 100));
        $data['customer_agreement'] = $kul_lagat->customer_agreement_contingency == null  ? $kul_lagat->customer_agreement : ($kul_lagat->customer_agreement) * (1 - ($kul_lagat->customer_agreement_contingency / 100));
    }

    return collect($data);
}

function returnGender($param)
{
    $gender = "";
    if ($param == null) {
        return '';
    }
    switch ($param) {
        case 'female':
            $gender = "महिला";
            break;
        case 'male':
            $gender = "पुरुष";
            break;
        case 'other':
            $gender = "अन्य";
            break;
        default:
            $gender = "";
            break;
    }
    return $gender;
}

function get_setting($slug)
{
    $setting = Setting::where(['slug' => $slug, 'is_deleted' => false])->first();
    return SettingValue::where(['setting_id' => $setting->id, 'is_deleted' => false])->get();
}

function convertNumberToNepaliWord($num = '')
{
    $num_nepali = array('पहिलो', 'दोस्रो', 'तेस्रो', 'चौथो', 'पाँचौ', 'छैठौं', 'सातौँ', 'आठौं', 'नवौँ', 'दसौं');
    $num_eng = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
    return str_replace($num_eng, $num_nepali, $num);
}
