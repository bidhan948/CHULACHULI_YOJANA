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

function getPreciseFloat($amount, $decimal)
{
    $explode = explode('.', $amount);
    $decimalPlace =  substr($explode[1] ?? '0', 0, $decimal);
    return $explode[0] . '.' . $decimalPlace;
}

function twoDigit($num)
{
    $two_digit = array(
        0 => "", 1 => "एक", 2 => "दुइ", 3 => "तीन", 4 => "चार", 5 => "पाच", 6 => "छ", 7 => "सात", 8 => "आठ", 9 => "नौ", 10 => "दश", 11 => "एघार", 12 => "बाह्र", 13 => "तेह्र", 14 => "चौध", 15 => "पन्ध्र", 16 => "सोह्र",
        17 => "सत्र", 18 => "अठार", 19 => "उन्नाइस", 20 => "बिस", 21 => "एक्काइस", 22 => "बाइस", 23 => "तेईस", 24 => "चौविस", 25 => "पच्चिस", 26 => "छब्बिस", 27 => "सत्ताइस", 28 => "अठ्ठाईस", 29 => "उनन्तिस",
        30 => "तिस", 31 => "एकत्तिस", 32 => "बत्तिस", 33 => "तेत्तिस", 34 => "चौँतिस", 35 => "पैँतिस", 36 => "छत्तिस", 37 => "सैँतीस", 38 => "अठतीस", 39 => "उनन्चालीस",
        40 => "चालीस", 41 => "एकचालीस", 42 => "	बयालीस", 43 => "त्रियालीस", 44 => "चवालीस", 45 => "पैँतालीस", 46 => "छयालीस", 47 => "सच्चालीस", 48 => "अठचालीस", 49 => "उनन्चास",
        50 => "पचास", 51 => "एकाउन्न", 52 => "बाउन्न", 53 => "त्रिपन्न", 54 => "चउन्न", 55 => "पचपन्न", 56 => "छपन्न", 57 => "सन्ताउन्न", 58 => "अन्ठाउन्न", 59 => "उनन्साठी",
        60 => "साठी", 61 => "एकसट्ठी", 62 => "बयसट्ठी", 63 => "त्रिसट्ठी", 64 => "चौंसट्ठी", 65 => "पैंसट्ठी", 66 => "छयसट्ठी", 67 => "सतसट्ठी", 68 => "अठसट्ठी", 69 => "उनन्सत्तरी",
        70 => "सत्तरी", 71 => "एकहत्तर", 72 => "बहत्तर", 73 => "त्रिहत्तर", 74 => "चौहत्तर", 75 => "पचहत्तर", 76 => "छयहत्तर", 77 => "सतहत्तर", 78 => "अठहत्तर", 79 => "उनासी",
        80 => "असी", 81 => "एकासी", 82 => "बयासी", 83 => "त्रियासी", 84 => "चौरासी", 85 => "पचासी", 86 => "छयासी", 87 => "सतासी", 88 => "अठासी", 89 => "उनान्नब्बे",
        90 => "नब्बे", 91 => "एकान्नब्बे", 92 => "बयानब्बे", 93 => "त्रियान्नब्बे", 94 => "चौरान्नब्बे", 95 => "पन्चानब्बे", 96 => "छयान्नब्बे", 97 => "सन्तान्नब्बे", 98 => "अन्ठान्नब्बे", 99 => "उनान्सय"
    );
    if (intval($num) == 0) {
        return "";
    } else {
        $new = intval($num);
        return $two_digit[$new];
    }
}
function threeDigit($num)
{
    if (substr($num, 0, 1) == 0) {
        $output = twoDigit(substr($num, 1, 2));
    } elseif (intval(substr($num, 1, 2) != 0)) {
        $result = twoDigit(substr($num, 0, 1));
        $result2 = twoDigit(substr($num, 1, 2));
        $output = $result . " सय " . $result2;
    } elseif (intval(substr($num, 1, 2) == 0)) {
        $result = twoDigit(substr($num, 0, 1));
        $result2 = twoDigit(substr($num, 1, 2));
        $output = $result . " सय " . $result2;
    }
    return $output;
}
function fiveDigit($num)
{
    if (intval(substr($num, 0, 2) == 0)) {
        $output = threeDigit(substr($num, 2, 3));
    } elseif (intval(substr($num, 0, 2) != 0)) {
        $output =  twoDigit(substr($num, 0, 2)) . " हजार " . threeDigit(substr($num, 2, 3));
    } elseif ((substr($num, 0, 5) == 0)) {
        $output = "";
    }
    return $output;
}
function sevenDigit($num)
{
    if (intval(substr($num, 0, 2) == 0)) {
        $output = fiveDigit(substr($num, 2, 5));
    } elseif (intval(substr($num, 0, 2) != 0)) {
        $output =  twoDigit(substr($num, 0, 2)) . " लाख " . fiveDigit(substr($num, 2, 5));
    } elseif ((substr($num, 0, 7) == 0)) {
        $output = "";
    }
    return $output;
}

function convert_number($post)
{
    $length = strlen($post);
    $num = $post;

    $output = twoDigit(substr($num, -2));

    if ($length == 3) {
        $output = threeDigit($num);
    }
    if ($length == 4) {

        $result = threeDigit(substr($num, 1, 3));
        $res = twoDigit(substr($num, 0, 1));
        $output = $res . " हजार " . $result;
    }
    if ($length == 5) {
        $result = twoDigit(substr($num, 0, 2));
        $res = threeDigit(substr($num, 2, 3));
        $output = $result . " हजार " . $res;
    }
    if ($length == 6) {
        $result = twoDigit(substr($num, 0, 1));
        $res = fiveDigit(substr($num, 1, 5));
        $output = $result . " लाख " . $res;
    }
    if ($length == 7) {
        $result = twoDigit(substr($num, 0, 2));
        $res = fiveDigit(substr($num, 2, 5));
        $output = $result . " लाख " . $res;
    }
    if ($length == 8) {
        $result = twoDigit(substr($num, 0, 1));
        $res = sevenDigit(substr($num, 1, 7));
        $output = $result . " क्रोर " . $res;
    }
    if ($length == 9) {
        $result = twoDigit(substr($num, 0, 2));
        $res = sevenDigit(substr($num, 2, 7));
        $output = $result . " क्रोर " . $res;
    }
    return $output;
}
function convert($post)
{
    $result = '';
    $num = explode(".", $post);
    $result .= convert_number($num[0]);
    if (!empty($num[1])) {
        $result .= "- " . convert_number($num[1]) . " पैसा";
    } else {
        $result .= "";
    }

    return $result;
}
