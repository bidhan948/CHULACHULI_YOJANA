<?php

namespace App\Http\Controllers\PisControllers;

use App\Http\Controllers\Controller;
use App\Http\Helper\MediaHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\NepaliCalender;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffAddress;
use App\Models\PisModel\StaffAppointment;
use App\Models\PisModel\StaffAward;
use App\Models\PisModel\StaffDetail;
use App\Models\PisModel\StaffEducation;
use App\Models\PisModel\StaffLanguage;
use App\Models\PisModel\StaffLeave;
use App\Models\PisModel\StaffPrevAppointment;
use App\Models\PisModel\StaffProfile;
use App\Models\PisModel\StaffPunishment;
use App\Models\PisModel\StaffService;
use App\Models\PisModel\StaffTraining;
use App\Models\PisModel\StaffWork;
use App\Models\SharedModel\District;
use App\Models\SharedModel\FiscalYear;
use App\Models\SharedModel\Municipality;
use App\Models\SharedModel\Province;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{

    private $_forms = array(
        'staff-form-1' => 'कर्मचारीको पूरा नाम र थर / प्रकार',
        'staff-form-2' => 'ठेगाना सम्बन्धी विवरण',
        'staff-form-3' => 'अन्य वैयक्तिक विवरण',
        'staff-form-4' => 'भाषाको दक्षता सम्बन्धी विवरण',
        'staff-form-5' => 'कर्मचारीको शुरु नियुक्तिको विवरण',
        'staff-form-6' => 'काम गरेको भए सोको विवरण',
        'staff-form-7' => 'अन्य विवरण',
        'staff-form-8' => 'सेवा सम्बन्धी विवरण',
        'staff-form-9' => 'शैक्षिक योग्यता',
        'staff-form-10' => 'तालिम / सेमिनार / सम्मेलेन सम्बन्धी विवरण',
        'staff-form-11' => 'विभूषण, प्रशांसा पत्र र पुरस्कारको विवरण',
        'staff-form-12' => 'विभागीय सजायको विवरण ',
        'staff-form-13' => 'विदा र औषधी उपचारको विवरण',
        'staff-form-14' => 'वर्गीकृत क्षेत्रहरुमा काम गरेको विवरण'
    );
    private $_bs = array(
        // 0 => array(2000, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 1 => array(2001, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 2 => array(2002, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 3 => array(2003, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 4 => array(2004, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 5 => array(2005, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 6 => array(2006, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 7 => array(2007, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 8 => array(2008, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        // 9 => array(2009, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 10 => array(2010, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 11 => array(2011, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 12 => array(2012, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        // 13 => array(2013, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 14 => array(2014, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 15 => array(2015, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 16 => array(2016, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        // 17 => array(2017, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 18 => array(2018, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 19 => array(2019, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 20 => array(2020, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        // 21 => array(2021, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 22 => array(2022, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        // 23 => array(2023, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 24 => array(2024, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        // 25 => array(2025, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 26 => array(2026, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 27 => array(2027, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 28 => array(2028, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 29 => array(2029, 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30),
        // 30 => array(2030, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 31 => array(2031, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        // 32 => array(2032, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 33 => array(2033, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 34 => array(2034, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 35 => array(2035, 30, 32, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        // 36 => array(2036, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        // 37 => array(2037, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        // 38 => array(2038, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        // 39 => array(2039, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        40 => array(2040, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        41 => array(2041, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        42 => array(2042, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        43 => array(2043, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        44 => array(2044, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        45 => array(2045, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        46 => array(2046, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        47 => array(2047, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        48 => array(2048, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        49 => array(2049, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        50 => array(2050, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        51 => array(2051, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        52 => array(2052, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        53 => array(2053, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        54 => array(2054, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        55 => array(2055, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        56 => array(2056, 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30),
        57 => array(2057, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        58 => array(2058, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        59 => array(2059, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        60 => array(2060, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        61 => array(2061, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        62 => array(2062, 30, 32, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31),
        63 => array(2063, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        64 => array(2064, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        65 => array(2065, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        66 => array(2066, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31),
        67 => array(2067, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        68 => array(2068, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        69 => array(2069, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        70 => array(2070, 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30),
        71 => array(2071, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        72 => array(2072, 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30),
        73 => array(2073, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31),
        74 => array(2074, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        75 => array(2075, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        76 => array(2076, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        77 => array(2077, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31),
        78 => array(2078, 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30),
        79 => array(2079, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30),
        80 => array(2080, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30),
        // 81 => array(2081, 31, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 82 => array(2082, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 83 => array(2083, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        // 84 => array(2084, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
        // 85 => array(2085, 31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        // 86 => array(2086, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 87 => array(2087, 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30),
        // 88 => array(2088, 30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30),
        // 89 => array(2089, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
        // 90 => array(2090, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30)
    );
    private $_genders = array('female' => 'महिला', 'male' => 'पुरुष');
    private $_sources = array('1' => 'हिमाली', '2' => 'पहाडी', '3' => 'तराई/मधेश');
    private $_divisions = array('1' => 'क', '2' => 'ख', '3' => 'ग', '4' => 'घ', '5' => 'ङ', '6' => 'खुला', '7' => 'महिला');
    private $_technicals = array('1' => 'प्राविधिक', '2' => 'अप्राविधिक');
    private $_countries = array('usa' => 'आमेरिका', 'japan' => 'जापान', 'canada' => 'क्यानेडा', 'uk' => 'बेलायत');
    private $_appoints = array('1' => 'नयाँ नियुक्ति', '2' => 'सरुवा', '3' => 'बढुवा');
    private $_yns = array('1' => 'छ', '0' => 'छैन');
    private $_yn2s = array('1' => 'हो', '0' => 'होइन');
    private $_appoinments = array('1' => 'नयाँ नियुक्ति','2'=>'नयाँ नियुक्ति सरुवा ', '3' => ' सरुवा बढुवा', '4' => 'बढुवा');


    


    private $setup_office_groups = 'setup_office_groups';
    private $setup_office_subgroups = 'setup_office_subgroups';
    private $setup_ethnicities = 'setup_ethnicities';
    private $setup_staff_category = 'setup_staff_category';
    private $setup_staff_subcategory = 'setup_staff_subcategory';
    private $setup_religions = 'setup_religions';
    private $setup_physicals = 'setup_physicals';
    private $setup_faces = 'setup_faces';
    private $setup_bgroups = 'setup_bgroups';
    private $setup_occupations = 'setup_occupations';
    private $setup_languages = 'setup_languages';
    private $setup_f_languages = 'setup_f_languages';
    private $setup_services = 'setup_services';
    private $setup_levels = 'setup_levels';
    private $setup_positions = 'setup_positions';
    private $setup_edu_qualifications = 'setup_edu_qualifications';
    private $setup_edu_subjects = 'setup_edu_subjects';
    private $setup_edu_positions = 'setup_edu_positions';
    private $setup_edu_institutes = 'setup_edu_institutes';
    private $setup_punishments = 'setup_punishments';

    private function get_setting($slug)
    {
        $setting = Setting::where(['slug' => $slug, 'is_deleted' => false])->first();
        return SettingValue::where(['setting_id' => $setting->id, 'is_deleted' => false])->get();
    }

    public function get_setup_staff_sub_category(Request $request)
    {
        $id = $request->id;
        $data = SettingValue::where(['cascading_parent_id' => $id, 'is_deleted' => false])->get();
        return response()->json($data);
    }

    public function get_local_lang()
    {
        $languages = $this->get_setting($this->setup_languages);
        return response()->json($languages);
        
    }

    public function staff_form()
    {
        session(['active_app' => 'pis']);
        return $this->staff_form_page_1();
    }


    public function staff_form_page_1()
    {
        $districts = District::select('id', 'name', 'nep_name')->get();
        $staff_categories = $this->get_setting($this->setup_staff_category);
        $occupations = $this->get_setting($this->setup_occupations);
        $user = auth()->user();
        $data = Staff::where('user_id', $user->id)->first();
        $staff_sub_cat= SettingValue::query()->where('setting_id',5)->get();
        return view('pis.staff.staff_form_page_1', [
            'districts' => $districts,
            'staff_categories' => $staff_categories,
            'occupations' => $occupations,
            'data' => $data,
            'staff_sub_cat'=>$staff_sub_cat
        ]);
    }

    public function staff_form_page_1_save(Request $request,MediaHelper $mediaHelper)
    {
        $user = auth()->user();
        $validate = $request->validate([
            's_no'=> 'required',
            'nep_name'=> 'required',
            'name'=> 'required',
            'dob'=> 'required',
            'cs_no'=> 'required',
            'nep_name'=> 'required',
            'category_id'=> 'required',
        ]);
        if ($request->hasFile('photo')) {
          $image=  $mediaHelper->uploadSingleImage($request->photo);
          $data_to_insert = $validate + [
            'user_id' => $user->id,
            'cs_district'=> $request->cs_district,
            'cs_issue'=> $request->cs_issue,
            'father_nep_name'=> $request->father_nep_name,
            'father_name'=> $request->father_name,
            'father_occupation'=> $request->father_occupation,
            'g_father_nep_name'=> $request->g_father_nep_name,
            'g_father_name'=> $request->g_father_name,
            'g_father_occupation'=> $request->g_father_occupation,
            'mother_name'=> $request->mother_name,
            'mother_nep_name'=> $request->mother_nep_name,
            'mother_occupation'=> $request->mother_occupation,
            'spouse_name'=> $request->spouse_name,
            'spouse_nep_name'=> $request->spouse_nep_name,
            'spouse_occupation'=> $request->spouse_occupation,
            'daughters_no'=> $request->daughters_no,
            'sub_category_id'=> $request->sub_category_id,
            'sons_no'=> $request->sons_no,
            'photo'=>$image,
        ];
        }
        else{
            $data_to_insert = $validate + [
                'user_id' => $user->id,
                'cs_district'=> $request->cs_district,
                'cs_issue'=> $request->cs_issue,
                'father_nep_name'=> $request->father_nep_name,
                'father_name'=> $request->father_name,
                'father_occupation'=> $request->father_occupation,
                'g_father_nep_name'=> $request->g_father_nep_name,
                'g_father_name'=> $request->g_father_name,
                'g_father_occupation'=> $request->g_father_occupation,
                'mother_name'=> $request->mother_name,
                'mother_nep_name'=> $request->mother_nep_name,
                'mother_occupation'=> $request->mother_occupation,
                'spouse_name'=> $request->spouse_name,
                'spouse_nep_name'=> $request->spouse_nep_name,
                'spouse_occupation'=> $request->spouse_occupation,
                'daughters_no'=> $request->daughters_no,
                'sub_category_id'=> $request->sub_category_id,
                'sons_no'=> $request->sons_no,
                'photo'=>null,
            ];
        }
      
        $staff = Staff::where('user_id', $user->id)->first();
        if(empty($staff)) {
            $db_response =  Staff::create($data_to_insert);
        }else {
            $db_response =  $staff->update($data_to_insert);
        }
        return redirect()->route('page_2_show');    
        // return $this->staff_form_page_2();
    }

    public function staff_form_page_2()
    {
        $provinces = Province::get();
        $districts= District::get();
        $districts= District::get();
        $municipalities= Municipality::get();
        $user = auth()->user();
        $data = StaffAddress::where('user_id', $user->id)->first();
        return view('pis.staff.staff_form_page_2', [
            'provinces' => $provinces,
            'districts'=>$districts,
            'municipalities'=>$municipalities,
            'data' => $data
        ]);
    }

    public function staff_form_page_2_save(Request $request)
    {
        $user = auth()->user();
        $validate = $request->validate([
            'p_province'=> 'required',
            'p_district'=> 'required',
            'p_municipality'=> 'required',
        ]);
        $data_to_insert = $validate + [
            'user_id' => $user->id,
            't_province'=> $request->t_province,
            't_district'=> $request->t_district,
            't_municipality'=> $request->t_municipality,
            'p_ward'=> $request->p_ward,
            't_ward'=> $request->t_ward,
            'p_tole'=> $request->p_tole,
            't_tole'=> $request->t_tole,
            'p_ward_nep'=> $request->p_ward_nep,
            't_ward_nep'=> $request->t_ward_nep,
            'p_tole_nep'=> $request->p_tole_nep,
            't_tole_nep'=> $request->t_tole_nep,
            'p_house_no'=> $request->p_house_no,
            't_house_no'=> $request->t_house_no,
            'p_house_no_nep'=> $request->p_house_no_nep,
            't_house_no_nep'=> $request->t_house_no_nep,
            'p_contact'=> $request->p_contact,
            't_contact'=> $request->t_contact,
            'email'=>$request->email
        ];

        $staff = StaffAddress::where('user_id', $user->id)->first();
        if(empty($staff)) {
            $db_response =  StaffAddress::create($data_to_insert);
        }else {
            $db_response =  $staff->update($data_to_insert);
        }
        return redirect()->route('page_3_show');    

    }


    public function staff_form_page_3()
    {
        $user = auth()->user();
        $physicals = $this->get_setting($this->setup_physicals);
        $religions = $this->get_setting($this->setup_religions);
        $ethnicities = $this->get_setting($this->setup_ethnicities);
        $faces = $this->get_setting($this->setup_faces);
        $bgroups = $this->get_setting($this->setup_bgroups);
        $staff_form_page_3_data = '';
        $data = StaffProfile::where('user_id', $user->id)->first();
        return view('pis.staff.staff_form_page_3', [
            'religions' => $religions,
            'ethnicities' => $ethnicities,
            'faces' => $faces,
            'bgroups' => $bgroups,
            'physicals' => $physicals,
            'genders' => $this->_genders,
            'sources' => $this->_sources,
            'divisions' => $this->_divisions,
            'data'=>$data,
            'staff_form_page_3_data' => $staff_form_page_3_data,
        ]);
    }

    public function staff_form_page_3_save(Request $request)
    {
        $user=auth()->user();
        $validate = $request->validate([
            'gender'=> 'required',
            'religion'=> 'required',
            'ethnicity'=> 'required',
        ]);
        $data_to_insert=$validate+[
            'user_id'=>$user->id,
            'face'=>$request->face,
            'blood_group'=>$request->blood_group,
            'source'=>$request->source,
            'janjati'=>$request->janjati,
            'janjati_other'=>$request->janjati_other,
            'madesi'=>$request->madesi,
            'madesi_other'=>$request->madesi_other,
            'dalit'=>$request->dalit,
            'dalit_other'=>$request->dalit_other,
            'low'=>$request->low,
            'low_other'=>$request->low_other,
            'disable'=>$request->disable,
            'disable_other'=>$request->disable_other,
            'is_division'=>$request->is_division
        ];
        $staff = StaffProfile::where('user_id', $user->id)->first();
        if(empty($staff)) {
            $db_response =  StaffProfile::create($data_to_insert);
        }else {
            $db_response =  $staff->update($data_to_insert);
        }
        return redirect()->route('page_4_show');    
    }

    public function staff_form_page_4()
    {
        $languages = $this->get_setting($this->setup_languages);
        $foreign_languages = $this->get_setting($this->setup_f_languages);
        $data=StaffLanguage::query()->where('user_id',auth()->user()->id)->get();
        $staffLanguage=StaffProfile::query()->where('user_id',auth()->user()->id)->first();
        return view('pis.staff.staff_form_page_4',['languages'=>$languages,'foreign_languages'=>$foreign_languages,'data'=>$data,'staffLanguage'=>$staffLanguage]);
    }

    public function staff_form_page_4_save(Request $request)
    {
        $user=auth()->user();
     
        $request->validate([
            'local_language'=>'required'
        ]);

        $staffLang= StaffLanguage::query()->where('user_id',$user->id)->get();
        if (count($staffLang)>0) {
           foreach ($staffLang as $key => $value) {
             $value->delete();
           }
        }

        DB::transaction(function () use ($request,$user)  {

        foreach ($request->language as $key => $value) {
           StaffLanguage::create([
               'user_id'=>$user->id,
               'language'=>$request->language[$key],
               'type'=>'local',
               'writing'=>$request->writing[$key],
               'reading'=>$request->reading[$key],
               'speaking'=>$request->speaking[$key]
           ]);
        }
        foreach ($request->language2 as $key => $value) {
            StaffLanguage::create([
                'user_id'=>$user->id,
                'language'=>$request->language2[$key],
                'type'=>'foreign',
                'writing'=>$request->writing2[$key],
                'reading'=>$request->reading2[$key],
                'speaking'=>$request->speaking[$key]
            ]);
        }
        StaffProfile::query()->where('id',$user->id)->update([
            'local_language'=>$request->local_language
        ]);
        });
        return redirect()->route('page_5_show');    

    }
    public function staff_form_page_5()
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups= $this->get_setting($this->setup_office_groups);
        $data= StaffAppointment::query()->where('user_id',auth()->user()->id)->get();
        return view('pis.staff.staff_form_page_5',['services'=>$services,'levels'=>$levels,'positions'=>$positions,'officeGroups'=>$officeGroups,'data'=>$data]);
    }


    public function staff_form_page_5_save(Request $request)
    {
        $user = auth()->user();
        $validate = $request->validate([
            'office_name_address'=> 'required',
        ]);
        $data_to_insert = $validate + [
            'user_id' => $user->id,
            'appoint_date'=> $request->appoint_date,
            'decision_date'=> $request->decision_date,
            'attend_date'=> $request->attend_date,
            'service'=> $request->service,
            'office_group'=> $request->office_group,
            'level'=> $request->level,
            'position'=> $request->position,
            'technical'=> $request->technical,
        ];
        $staff = StaffAppointment::where('user_id', $user->id)->first();
        if (empty($staff)) {
        StaffAppointment::create($validate+$data_to_insert);
        }
        else{
        StaffAppointment::query()->where('user_id',$user->id)->update($data_to_insert);
        }
        return redirect()->route('page_6_show');    
    }
    public function staff_form_page_6()
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups= $this->get_setting($this->setup_office_groups);
        $data= StaffPrevAppointment::query()->where('user_id',auth()->user()->id)->get();
        return view('pis.staff.staff_form_page_6',['services'=>$services,'levels'=>$levels,'positions'=>$positions,'officeGroups'=>$officeGroups,'data'=>$data]);
    }

    public function staff_form_page_6_save(Request $request)
    {
        $user = auth()->user();
        $validate = $request->validate([
            'office_name_address'=> 'required',
        ]);
        $data_to_insert = $validate + [
            'user_id' => $user->id,
            'service'=> $request->service,
            'office_group'=> $request->office_gr,
            'level'=> $request->level,
            'position'=> $request->position,
            'technical'=> $request->technical,
            "leave_date" => $request->leave_date,
            "leave_reason" => $request->leave_reason
        ];
        $staff = StaffPrevAppointment::where('user_id', $user->id)->first();
        if (empty($staff)) {
            StaffPrevAppointment::create($validate+$data_to_insert);
        }
        else{
            StaffPrevAppointment::query()->where('user_id',$user->id)->update($data_to_insert);
        }
        return redirect()->route('page_7_show');    
        
    }
    public function staff_form_page_7()
    {
        $data=StaffDetail::query()->where('user_id',auth()->user()->id)->get();
        return view('pis.staff.staff_form_page_7',['countries'=>$this->_countries,'data'=>$data]);
    }

    public function staff_form_page_7_save(Request $request)
    {

        $request->validate([
            'qualification'=>'required'
        ]);
        $user=auth()->user();   
       
        
        $data_to_insert = [
            'user_id'=>$user->id,
           'poly_marriage'=>$request->poly_marriage,
           'poly_spouse_name'=>$request->poly_spouse_name,
           'foreign_spouse_apply'=>$request->foreign_spouse_apply,
           'fa_country'=>$request->fa_country,
           'fa_date'=>$request->fa_date,
           'fa2_country'=>$request->fa2_country,
           'fa2_date'=>$request->fa2_date,
           'loan_detail'=>$request->loan_detail,
           'loan'=>$request->loan,
           'qualification'=>$request->qualification,
        ];

        $staffDetail= StaffDetail::query()->where('id',$user->id)->first();
        if (empty($staffDetail)) {
            StaffDetail::create($data_to_insert);
        }
        else {
            $staffDetail->update($data_to_insert);
        }
        return redirect()->route('page_8_show');    
        
    }
    public function staff_form_page_8()
    {
        $services = $this->get_setting($this->setup_services);
        $levels = $this->get_setting($this->setup_levels);
        $positions = $this->get_setting($this->setup_positions);
        $officeGroups= $this->get_setting($this->setup_office_groups);
        $data=StaffService::query()->where('user_id',auth()->user()->id)->get();

       if (count($data)>0) {
        return view('pis.staff.edit_staff_form_page_8',['appoints'=>$this->_appoinments,
        'services'=>$services,
        'levels'=>$levels,
        'positions'=>$positions,
        'officeGroups'=>$officeGroups,
        'data'=>$data]);
       }
       else{
        return view('pis.staff.staff_form_page_8',['appoints'=>$this->_appoinments,
        'services'=>$services,
        'levels'=>$levels,
        'positions'=>$positions,
        'officeGroups'=>$officeGroups,
        'data'=>$data]);
       }
       
    }

    public function staff_form_page_8_save(Request $request)
    {
        $user=auth()->user();
        // dd($request->all());
        $staffService= StaffService::query()->where('user_id',$user->id)->get();
        if (count($staffService)>0) {
            foreach ($staffService as $key => $value) {
                $value->delete();
            }
        }

            foreach ($request->service as $key => $value) {
               StaffService::create([
                   'user_id'=>$user->id,
                   'service'=>$request->service[$key],
                   'office_group'=>$request->office_group[$key],
                   'position'=>$request->position[$key],
                   'level'=>$request->level[$key],
                   'office_name_address'=>$request->office_name_address[$key],
                   'office_name_address_english'=>$request->office_name_address_english[$key],
                   'new_appoint'=>$request->new_appoint[$key],
                   'decision_date'=>$request->decision_date[$key],
                   'restoration_date'=>$request->restoration_date[$key],
               ]);
            }
            return redirect()->route('page_9_show');    
        }
    public function staff_form_page_9()
    {
        $positions = $this->get_setting($this->setup_edu_positions);
        $subjects = $this->get_setting($this->setup_edu_subjects);
        $qualifications = $this->get_setting($this->setup_edu_qualifications);
        $institutes = $this->get_setting($this->setup_edu_institutes);
        $data= StaffEducation::query()->where('user_id',auth()->user()->id)->get();
        if (count($data)>0) {
            return view('pis.staff.edit_staff_form_page_9',['postitions'=>$positions,
            'subjects'=>$subjects,'qualifications'=>$qualifications,'date'=>$this->_bs,'institutes'=>$institutes,'data'=>$data]);
        }
        else{
            return view('pis.staff.staff_form_page_9',['postitions'=>$positions,'subjects'=>$subjects,'qualifications'=>$qualifications,'date'=>$this->_bs,'institutes'=>$institutes]);

        }
    }

    public function staff_form_page_9_save(Request $request)
    {
        $user=auth()->user();
           $staffEducation= StaffEducation::query()->where('user_id',$user->id)->get();
        if (count($staffEducation)>0) {
            foreach ($staffEducation as $key => $value) {
                $value->delete();
            }
        }
        $key=1;
       foreach ($request->subject as $key => $value) {
           StaffEducation::create([
               'user_id'=>$user->id,
               'qualification'=>$request->qualification[$key],
               'subject'=>$request->subject[$key],
               'year'=>$request->year[$key],
               'position'=>$request->position[$key],
               'institute'=>$request->institute[$key],
           ]);
       }

       return redirect()->route('page_10_show');    
    }

    public function staff_form_page_10()
    {
        return view('pis.staff.staff_form_page_10');
    }

    public function staff_form_page_10_save(Request $request)
    {
        $user= auth()->user();
       $staffTraining= StaffTraining::query()->where('user_id',$user->id)->get();
       if (count($staffTraining)>0) {
             foreach ($staffTraining as $key => $value) {
                 $value->delete();
            }
         }
         foreach ($request->detail as $key => $value) {
            StaffTraining::create([
                'user_id'=>$user->id,
                'detail'=>$request->detail[$key],
                'date'=>$request->date[$key],
                'type'=>$request->type[$key],
                'institute'=>$request->institute[$key]
            ]);
         }

         return redirect()->route('page_11_show');    
        }

    public function staff_form_page_11()
    {
        return view('pis.staff.staff_form_page_11');
    }

    public function staff_form_page_11_save(Request $request)
    {
        $user= auth()->user();
        $staffAward= StaffAward::query()->where('user_id',$user->id)->get();
        if (count($staffAward)>0) {
              foreach ($staffAward as $key => $value) {
                  $value->delete();
             }
          }
          foreach ($request->award_detail as $key => $value) {
             StaffAward::create([
                 'user_id'=>$user->id,
                 'award_detail'=>$request->award_detail[$key],
                 'received_date'=>$request->received_date[$key],
                 'reason'=>$request->reason[$key],
                 'convenience'=>$request->convenience[$key]
             ]);
          }
          return redirect()->route('page_12_show');    

    }

    public function staff_form_page_12()
    {
        $punishments = $this->get_setting($this->setup_punishments);
        return view('pis.staff.staff_form_page_12',['punishments'=>$punishments]);
    }
    public function staff_form_page_12_save(Request $request)
    {
        $user= auth()->user();
        $staffPunishment= StaffPunishment::query()->where('user_id',$user->id)->get();
        if (count($staffPunishment)>0) {
              foreach ($staffPunishment as $key => $value) {
                  $value->delete();
             }
          }
          foreach ($request->punishment as $key => $value) {
            StaffPunishment::create([
                 'user_id'=>$user->id,
                 'punishment'=>$request->punishment[$key],
                 'ordered_date'=>$request->ordered_date[$key],
                 'stopped'=>$request->stopped[$key],
                 'stopped_date'=>$request->stopped_date[$key],
                 'remarks'=>$request->remarks[$key]
             ]);
          }
          return redirect()->route('page_13_show');    
    }
    public function staff_form_page_13()
    {
        $fiscal_years= FiscalYear::query()->where('is_current',1)->first();
            return view('pis.staff.staff_form_page_13',['fiscalYear'=>$fiscal_years]);
    }

    public function staff_form_page_13_save(Request $request)
    {

        $user= auth()->user();
        $staffLeaves= StaffLeave::query()->where('user_id',$user->id)->get();
        if (count($staffLeaves)>0) {
            foreach ($staffLeaves as $key => $value) {
                $value->delete();
            }
        }
        foreach ($request->detail as $key => $value) {
           StaffLeave::create([
               'user_id'=>$user->id,
               'detail'=>$request->detail[$key],
               'session'=>$request->session[$key],
               'home_new'=>$request->home_new[$key],
               'home_prev_left'=>$request->home_prev_left[$key],
               'home_total'=>$request->home_total[$key],
               'home_cost'=>$request->home_cost[$key],
               'home_left'=>$request->home_left[$key],
               'sick_new'=>$request->sick_new[$key],
               'sick_prev_left'=>$request->sick_prev_left[$key],
               'sick_total'=>$request->sick_total[$key],
               'sick_cost'=>$request->sick_cost[$key],
               'sick_left'=>$request->sick_left[$key],
               'delivery_total'=>$request->delivery_total[$key],
               'delivery_cost'=>$request->delivery_cost[$key],
               'delivery_left'=>$request->delivery_left[$key],
               'study_total'=>$request->study_total[$key],
               'study_cost'=>$request->study_cost[$key],
               'study_left'=>$request->study_left[$key],
               'uncommon_total'=>$request->uncommon_total[$key],
               'uncommon_cost'=>$request->uncommon_cost[$key],
               'uncommon_left'=>$request->uncommon_left[$key],
               'bedroom_total'=>$request->bedroom_total[$key],
               'bedroom_cost'=>$request->bedroom_cost[$key],
               'bedroom_left'=>$request->bedroom_left[$key],
               'from_date'=>$request->from_date[$key],
               'to_date'=>$request->to_date[$key],
               'to_from_total'=>$request->to_from_total[$key],
               'kyabi_total'=>$request->kyabi_total[$key],
               'kyabi_cost'=>$request->kyabi_cost[$key],
               'kyabi_left'=>$request->kyabi_left[$key],
               'pabi_total'=>$request->pabi_total[$key],
               'pabi_cost'=>$request->pabi_cost[$key],
               'pabi_left'=>$request->pabi_left[$key],
               'mc_amount'=>$request->mc_amount[$key],
               'remarks'=>$request->remarks[$key],
           ]);
        }
        return redirect()->route('page_14_show');    
        
    }
    public function staff_form_page_14()
    {
        return view('pis.staff.staff_form_page_14');
    }

    public function staff_form_page_14_save(Request $request)
    {
        $user = auth()->user();
        $staffWork= StaffWork::query()->where('user_id',$user->id)->get();
        if (count($staffWork)>0) {
            foreach ($staffWork as $key => $value) {
                $value->delete();
            }
        }
        // dd($request->all());
        // if () {
        //     # code...
        // }
        foreach ($request->from_date as $key => $value) {
            StaffWork::create([
                'user_id'=>$user->id,
                'from_date'=>$request->from_date[$key],
                'to_date'=>$request->to_date[$key],
                'post_area'=>$request->post_area[$key],
                'work_area'=>$request->work_area[$key],
                'a_work'=>$request->has('a_work') ? ( isset( $request->a_work[$key]) ? 1 : 0) : 0,
                'b_work'=>$request->has('b_work') ? ( isset( $request->b_work[$key]) ? 1 : 0) : 0,
                'c_work'=>$request->has('c_work') ? ( isset( $request->c_work[$key]) ? 1 : 0) : 0,
                'd_work'=>$request->has('d_work') ? ( isset( $request->d_work[$key]) ? 1 : 0) : 0,
                'e_work'=>$request->has('e_work') ? ( isset( $request->e_work[$key]) ? 1 : 0) : 0,
                'remarks'=>$request->remarks[$key],
            ]);
        }

    }

   

    public function localRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="tl_' . $r . '">';
            $html .= '<input type="hidden" name="local_ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="language_' . $r . '" name="language[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $languages = $this->get_setting($this->setup_languages);

            foreach ($languages as $language) {
                $html .= '<option value="' . $language->id . '">' . $language->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td><input type="radio" name="writing[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="writing[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="writing[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="reading[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="reading[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="reading[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="speaking[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="speaking[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="speaking[' . $r . ']" value="3" ></td>';
            $html .= '<td><a id="dl_' . $r . '" class="btn btn-sm btn-danger dl"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function foreignRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="tf_' . $r . '">';
            $html .= '<input type="hidden" name="foreign_ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="language2_' . $r . '" name="language2[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $languages = $this->get_setting($this->setup_f_languages);

            foreach ($languages as $language) {
                $html .= '<option value="' . $language->id . '">' . $language->name . '</option>';
            }
            $html .= '</select></td>';
            $html .= '<td><input type="radio" name="writing2[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="writing2[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="writing2[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="reading2[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="reading2[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="reading2[' . $r . ']" value="3" ></td>';
            $html .= '<td><input type="radio" name="speaking2[' . $r . ']" value="1" checked></td>';
            $html .= '<td><input type="radio" name="speaking2[' . $r . ']" value="2" ></td>';
            $html .= '<td><input type="radio" name="speaking2[' . $r . ']" value="3" ></td>';
            $html .= '<td><a id="df_' . $r . '" class="btn btn-sm btn-danger df"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function serviceRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="service_' . $r . '" name="service[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $services = $this->get_setting($this->setup_services);

            foreach ($services as $service) {
                $html .= '<option value="' . $service->id . '">' . $service->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;">';
            $html .= '<select id="office_group_' . $r . '" name="office_group[' . $r . ']" class="form-control select2"><option value="" data-eng="">समूह चयन</option>';
            $groups =  $this->get_setting($this->setup_office_groups);

            foreach ($groups as $group) {
                $html .= '<option value="' . $group->id . '">' . $group->name . '</option>';
            }

            $html .= '</select>';
            $html .= '<select id="office_subgroup_' . $r . '" name="office_subgroup[' . $r . ']" class="form-control select2"><option value="" data-eng="">उप समूह चयन</option>';
            $subgroups = $this->get_setting($this->setup_office_subgroups);

            foreach ($subgroups as $subgroup) {
                $html .= '<option value="' . $subgroup->id . '">' . $subgroup->name . '</option>';
            }

            $html .= '</select>';
            $html .= '</td>';
            $html .= '<td style="max-width: 200px;">';
            $html .= '<select id="position_' . $r . '" name="position[' . $r . ']" class="form-control select2"><option value="" data-eng="">पद चयन</option>';
            $positions = $this->get_setting($this->setup_positions);

            foreach ($positions as $position) {
                $html .= '<option value="' . $position->id . '">' . $position->name . '</option>';
            }

            $html .= '</select>';
            $html .= '<select id="level_' . $r . '" name="level[' . $r . ']" class="form-control select2"><option value="" data-eng="">श्रेणी चयन</option>';
            $levels = $this->get_setting($this->setup_levels);

            foreach ($levels as $level) {
                $html .= '<option value="' . $level->id . '">' . $level->name . '</option>';
            }

            $html .= '</select>';
            $html .= '</td>';
            $html .= '<td><input type="text" name="office_name_address[' . $r . ']" class="form-control" required></td>';
            $html .= '<td><input type="text" name="office_name_address_english[' . $r . ']" class="form-control" required></td>';
            $html .= '<td>';
            $a = 1;
            foreach ($this->_appoints as $v => $appoint) {
                if ($a == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                $a++;
                $html .= '<label style="font-weight: normal;"><input type="radio" name="appoint[' . $r . ']" value="' . $v . '" ' . $checked . '>' . $appoint . '</label>';
            }
            $html .= '</td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="decision_date_' . $r . '" name="decision_date[' . $r . ']" class="form-control nepaliDate ndp-custom"></div></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="restoration_date_' . $r . '" name="restoration_date[' . $r . ']" class="form-control nepaliDate ndp-custom"></div></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function educationRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $qualifications = $this->get_setting($this->setup_edu_qualifications);
            $subjects = $this->get_setting($this->setup_edu_subjects);
            $positions = $this->get_setting($this->setup_edu_positions);
            $institutes = $this->get_setting($this->setup_edu_institutes);
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="qualification_' . $r . '" name="qualification[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($qualifications as $qualification) {
                $html .= '<option value="' . $qualification->id . '">' . $qualification->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="subject_' . $r . '" name="subject[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($subjects as $subject) {
                $html .= '<option value="' . $subject->id . '">' . $subject->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="year_' . $r . '" name="year[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $latest_year = (int)date('Y') + 57;
            for ($year = $latest_year; $year >= 2040; $year--) {
                $html .= '<option value="' . $year . '">' . $year . '</option>';
            }
            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="position_' . $r . '" name="position[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($positions as $position) {
                $html .= '<option value="' . $position->id . '">' . $position->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td style="max-width: 200px;"><select id="institute_' . $r . '" name="institute[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';

            foreach ($institutes as $institute) {
                $html .= '<option value="' . $institute->id . '">' . $institute->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function trainingRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td><textarea id="detail_' . $r . '" name="detail[' . $r . ']" class="form-control" rows="3"></textarea></td>';
            $html .= '<td><input type="text" id="date_' . $r . '" name="date[' . $r . ']" class="form-control nepaliDate" value=""></td>';
            $html .= '<td><input type="text" id="type_' . $r . '" name="type[' . $r . ']" class="form-control" value=""></td>';
            $html .= '<td><input type="text" id="institute_' . $r . '" name="institute[' . $r . ']" class="form-control" value=""></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function awardRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td><input type="text" name="award_detail[' . $r . ']" class="form-control" required></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="received_date_' . $r . '" name="received_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><input type="text" name="reason[' . $r . ']" class="form-control"></td>';
            $html .= '<td><input type="text" name="convenience[' . $r . ']" class="form-control"></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function punishmentRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td style="max-width: 200px;"><select id="punishment_' . $r . '" name="punishment[' . $r . ']" class="form-control select2"><option value="" data-eng="">चयन गर्नुहोस्</option>';
            $punishments = $this->get_setting($this->setup_punishments);

            foreach ($punishments as $punishment) {
                $html .= '<option value="' . $punishment->id . '">' . $punishment->name . '</option>';
            }

            $html .= '</select></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="ordered_date_' . $r . '" name="ordered_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><label><input type="radio" name="stopped[' . $r . '" value="1"> हो</label><label><input type="radio" name="stopped[' . $r . ']" checked value="0"> होइन</label></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="stopped_date_' . $r . '" name="stopped_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><textarea name="remarks[' . $r . ']" class="form-control"></textarea></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function dwRowAddition(Request $request)
    {
        if (isset($request->row)) {
            $r = $request->row;
            $html = '<tr id="t_' . $r . '">';
            $html .= '<input type="hidden" name="ids[]" value="">';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="from_date_' . $r . '" name="form_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><div class="col-md-12 ndp-custom"><input type="text" id="to_date_' . $r . '" name="to_date[' . $r . ']" class="form-control nepaliDate"></div></td>';
            $html .= '<td><input type="text" name="post_area[' . $r . ']" class="form-control"></td>';
            $html .= '<td><input type="text" name="work_area[' . $r . ']" class="form-control"></td>';
            $html .= '<td><input type="checkbox" id="a_work_' . $r . '" name="a_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="b_work_' . $r . '" name="b_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="c_work_' . $r . '" name="c_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="d_work_' . $r . '" name="d_work[' . $r . ']" value="1"></td>';
            $html .= '<td><input type="checkbox" id="e_work_' . $r . '" name="e_work[' . $r . ']" value="1"></td>';
            $html .= '<td><textarea name="remarks[' . $r . ']" class="form-control"></textarea></td>';
            $html .= '<td><a id="d_' . $r . '" class="btn btn-sm btn-danger dr"><i class="fa fa-times"></i></a></td>';
            $html .= '<tr>';
            echo $html;
            die();
        }
        echo '0';
        die();
    }
}
