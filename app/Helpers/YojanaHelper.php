<?php

namespace App\Helpers;

use App\Models\PisModel\Staff;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\advance;
use App\Models\YojanaModel\BudgetSource;
use App\Models\YojanaModel\consumer;
use App\Models\YojanaModel\final_payment;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\running_bill_payment;
use App\Models\YojanaModel\setting\amanat;
use App\Models\YojanaModel\setting\decimal_point;
use App\Models\YojanaModel\setting\institutional_committee;
use App\Models\YojanaModel\setting\tole_bikas_samiti;

class YojanaHelper
{
    public function getRelationNameViaSession($relation = '')
    {
        $realtionName = "";
        switch ($relation) {
            case config('TYPE.tole-bikas-samiti'):
                $realtionName = 'toleBikasSamitiDetails';
                break;
            case config('TYPE.UPABHOKTA_SAMITI'):
                $realtionName = 'consumerDetails';
                break;
            case config('TYPE.SANSTHA_SAMITI'):
                $realtionName = 'institutionalCommitteeDetail';
                break;
            default:
                $realtionName = "";
                break;
        }
        return $realtionName;
    }

    public function getPostViasSession($type_id = '')
    {
        switch ($type_id) {
            case config('TYPE.tole-bikas-samiti'):
                $posts = Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues', function ($q) {
                        $q->where('id', config('constant.TOLE_SAMYOJAK_ID'))
                            ->orWhere('id', config('constant.TOLE_SADASYA_ID'));
                    })
                    ->first();
                break;
            case config('TYPE.UPABHOKTA_SAMITI'):
                $posts = Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues', function ($q) {
                        $q->where('id', config('constant.TOLE_SAMYOJAK_ID'))
                            ->orWhere('id', config('constant.TOLE_SADASYA_ID'));
                    })
                    ->first();
                break;
            case config('TYPE.SANSTHA_SAMITI'):
                $posts = Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues')
                    ->first();
                break;
            case config('TYPE.AMANAT_MARFAT'):
                $posts = Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues')
                    ->first();
                break;
            default:
                $posts = [];
                break;
        }
        return $posts;
    }

    public function sumOfContigency(int $plan_id)
    {
        $data = [];
        $kul_lagat = kul_lagat::query()->where('plan_id', $plan_id)->first();

        if ($kul_lagat != null) {
            $data['napa_amount'] = $kul_lagat->napa_contingency == null  ? $kul_lagat->napa_amount : ($kul_lagat->napa_amount) * (($kul_lagat->napa_contingency / 100));
            $data['other_office_con'] = $kul_lagat->other_office_con_contingency == null  ? $kul_lagat->other_office_con : ($kul_lagat->other_office_con) * (($kul_lagat->other_office_con_contingency / 100));
            $data['other_office_agreement'] = $kul_lagat->other_agreement_contingency == null  ? $kul_lagat->other_office_agreement : ($kul_lagat->other_office_agreement) * (($kul_lagat->other_agreement_contingency / 100));
            $data['customer_agreement'] = $kul_lagat->customer_agreement_contingency == null  ? $kul_lagat->customer_agreement : ($kul_lagat->customer_agreement) * (($kul_lagat->customer_agreement_contingency / 100));
        }

        return collect($data);
    }

    public function sumOfContingencyAmount(int $plan_id)
    {
        $data = [];
        $kul_lagat = kul_lagat::query()->where('plan_id', $plan_id)->first();

        if ($kul_lagat != null) {
            $data['napa_amount'] = $kul_lagat->napa_contingency == null  ? 0 : ($kul_lagat->napa_amount) * (($kul_lagat->napa_contingency / 100));
            $data['other_office_con'] = $kul_lagat->other_office_con_contingency == null  ? 0 : ($kul_lagat->other_office_con) * (($kul_lagat->other_office_con_contingency / 100));
            $data['other_office_agreement'] = $kul_lagat->other_agreement_contingency == null  ? 0 : ($kul_lagat->other_office_agreement) * (($kul_lagat->other_agreement_contingency / 100));
            $data['customer_agreement'] = $kul_lagat->customer_agreement_contingency == null  ? 0 : ($kul_lagat->customer_agreement) * (($kul_lagat->customer_agreement_contingency / 100));
        }

        return collect($data);
    }

    public function getTableRowOfTypePost($typeDetails)
    {
        $html = "";
        if (config('TYPE.TOLE_BIKAS_SAMITI') == session('type_id')) {
            $postColumnName = "position";
        } else {
            $postColumnName = "post_id";
        }
        $adakshyaName = $typeDetails->where($postColumnName, config('constant.TOLE_ADAKSHYA_ID'))->first();
        $sachibName = $typeDetails->where($postColumnName, config('constant.TOLE_SACHIB_ID'))->first();
        $kosAdakshyaName = $typeDetails->where($postColumnName, config('constant.TOLE_KOSADAKSHYA_ID'))->first();

        if ($adakshyaName != null) {
            $html .= "<tr>";
            $html .= "<td class='text-center'>अध्यक्ष</td>";
            $html .= "<td class='text-center' style='font-weight:lighter;'>" . $adakshyaName->name . "</td>";
            $html .= "<td class='text-center'></td>";
            $html .= "</tr>";
        }

        if ($sachibName != null) {
            $html .= "<tr>";
            $html .= "<td class='text-center'>सचिब</td>";
            $html .= "<td class='text-center' style='font-weight:lighter;'>" . $sachibName->name . "</td>";
            $html .= "<td class='text-center'></td>";
            $html .= "</tr>";
        }

        if ($kosAdakshyaName != null) {
            $html .= "<tr>";
            $html .= "<td class='text-center'>कोषाध्यक्ष</td>";
            $html .= "<td class='text-center' style='font-weight:lighter;'>" . $kosAdakshyaName->name . "</td>";
            $html .= "<td class='text-center'></td>";
            $html .= "</tr>";
        }

        return $html;
    }

    public function paymentRatio(plan $plan)
    {
        $kulLagat = $plan->load('kulLagat')->kulLagat;
        $sumWoContingency = $kulLagat->work_order_budget / $kulLagat->total_investment;

        $decimalPoint = decimal_point::query()
            ->where('fiscal_year_id', getCurrentFiscalYear(true)->id)
            ->first();

        return (float)number_format($sumWoContingency, $decimalPoint->name, '.', '');
    }

    public function checkAdvanceRunningBillFinalPayment($plan_id)
    {
        $advance = advance::query()
            ->where('plan_id', $plan_id)
            ->first();

        $running_bill_payment = running_bill_payment::query()
            ->where('plan_id', $plan_id)
            ->first();

        $final_payment = final_payment::query()
            ->where('plan_id', $plan_id)
            ->first();

        return ($advance == null ? ($running_bill_payment == null ? ($final_payment == null ? true : false) : false) : false);
    }

    public function calculateRunningBill($plan_id, $plan_evaluation_amount)
    {
        $kul_lagat = kul_lagat::query()->where('plan_id', $plan_id)->first();
        $running_bill_payments = running_bill_payment::query()->where('plan_id', $plan_id)->get();
        $plan_evaluation_amount_sum = $running_bill_payments->sum('plan_evaluation_amount');
        $total_investment = $kul_lagat->total_investment;
        $decimalPoint = decimal_point::query()
            ->where('fiscal_year_id', getCurrentFiscalYear(true)->id)
            ->first();

        if ($plan_evaluation_amount >= ($kul_lagat->total_investment - $plan_evaluation_amount_sum)) {
            $plan_evaluation_amount = ($kul_lagat->total_investment - $plan_evaluation_amount_sum);
        }
        // calculating each individual percentage
        $napa_percentage = $this->getPreciseFloat((($kul_lagat->napa_amount / $total_investment) * 100), $decimalPoint->name);
        $other_office_con_percentage = $this->getPreciseFloat((($kul_lagat->other_office_con / $total_investment) * 100), $decimalPoint->name);
        $other_office_agreement_percentage = $this->getPreciseFloat((($kul_lagat->other_office_agreement / $total_investment) * 100), $decimalPoint->name);
        $customer_agreement_percentage = $this->getPreciseFloat((($kul_lagat->customer_agreement / $total_investment) * 100), $decimalPoint->name);
        $consumer_budget_percentage = $this->getPreciseFloat((($kul_lagat->consumer_budget / $total_investment) * 100), $decimalPoint->name);

        // calculating amount of each individual without contingency
        $napa_amount_without_contingency = $this->getPreciseFloat((($napa_percentage * $plan_evaluation_amount) / 100), $decimalPoint->name);
        $other_office_con_without_contingency = $this->getPreciseFloat((($other_office_con_percentage * $plan_evaluation_amount) / 100), $decimalPoint->name);
        $other_office_agreement_without_contingency = $this->getPreciseFloat((($other_office_agreement_percentage * $plan_evaluation_amount) / 100), $decimalPoint->name);
        $customer_agreement_without_contingency = $this->getPreciseFloat((($customer_agreement_percentage * $plan_evaluation_amount) / 100), $decimalPoint->name);
        $consumer_budget_without_contingency = $this->getPreciseFloat((($consumer_budget_percentage * $plan_evaluation_amount) / 100), $decimalPoint->name);

        // calculating amount of each individual with contingency
        $napa_amount_contingency = $this->getPreciseFloat((($kul_lagat->napa_contingency * $napa_amount_without_contingency) / 100), $decimalPoint->name);
        $other_office_con_contingency = $this->getPreciseFloat((($kul_lagat->other_office_con_contingency * $plan_evaluation_amount) / 100), $decimalPoint->name);
        $other_office_agreement_contingency = $this->getPreciseFloat((($kul_lagat->other_agreement_contingency * $plan_evaluation_amount) / 100), $decimalPoint->name);
        $customer_agreement_contingency = $this->getPreciseFloat(((($kul_lagat->customer_agreement_contingency * $plan_evaluation_amount) / 100)), $decimalPoint->name);

        $sum_of_contingency = $this->getPreciseFloat(($napa_amount_contingency + $other_office_con_contingency + $other_office_agreement_contingency + $customer_agreement_contingency), $decimalPoint->name);

        $payable_amount = $this->getPreciseFloat($napa_amount_without_contingency + $other_office_con_without_contingency + $other_office_agreement_without_contingency + $customer_agreement_without_contingency, $decimalPoint->name);

        return [
            'napa_percentage' => $napa_percentage,
            'other_office_con_percentage' => $other_office_con_percentage,
            'other_office_agreement_percentage' => $other_office_agreement_percentage,
            'consumer_budget_percentage' => $consumer_budget_percentage,
            'napa_amount_without_contingency' => $napa_amount_without_contingency,
            'other_office_con_without_contingency' => $other_office_con_without_contingency,
            'other_office_agreement_without_contingency' => $other_office_agreement_without_contingency,
            'customer_agreement_without_contingency' => $customer_agreement_without_contingency,
            'consumer_budget_without_contingency' => $consumer_budget_without_contingency,
            'napa_amount_contingency' => $napa_amount_contingency,
            'other_office_con_contingency' => $other_office_con_contingency,
            'other_office_agreement_contingency' => $other_office_agreement_contingency,
            'customer_agreement_contingency' => $customer_agreement_contingency,
            'sum_of_contingency' => $sum_of_contingency,
            'payable_amount' => $payable_amount,
            'decimal_point' => $decimalPoint->name
        ];
    }

    public function returnTotalInvestmentWithOutContingency(kul_lagat $kul_lagat)
    {
        return $kul_lagat->napa_amount + $kul_lagat->other_office_con + $kul_lagat->other_office_agreement + $kul_lagat->customer_agreement + $kul_lagat->consumer_budget;
    }

    public function getPreciseFloat($amount, $decimal)
    {
        $explode = explode('.', $amount);
        $decimalPlace =  substr($explode[1] ?? '0', 0, $decimal);
        return $explode[0] . '.' . $decimalPlace;
    }

    public function getTypeAndChildren($slug)
    {
        switch ($slug) {
            case config('TYPE.SLUG.0'):
                $types = tole_bikas_samiti::query()->with('toleBikasSamitiDetails')->get();
                break;
            case config('TYPE.SLUG.1'):
                $types = consumer::query()->with('consumerDetails')->get();
                break;
            case config('TYPE.SLUG.2'):
                $types = institutional_committee::query()->with('institutionalCommitteeDetail')->get();
                break;
            default:
                $types = amanat::query()->get();
                break;
        }

        return $types;
    }

    public function uniqueUid()
    {
        $u_id = random_int(100, 200);
        if (Staff::query()->where('user_id', $u_id)->first() != null) {
            $this->uniqueUid();
        }
        return $u_id;
    }

    public function calculateRemainAmountBudgetSource($budgetSource_id)
    {
        $current_fiscal_year = getCurrentFiscalYear(true)->id;

        $budgetSource = BudgetSource::query()
            ->where('id', $budgetSource_id)
            ->withSum(['budget_source_deposit as amount' => function ($query) use ($current_fiscal_year) {
                $query->where('fiscal_year_id', $current_fiscal_year);
            }], 'amount')
            ->withSum(['budget_source_plan as amountToBeSubtracted' => function ($query) {
                $query->where('is_split', 0)->where('is_merge', 0);
            }], 'amount')
            ->with('budget_source_plan')
            ->first();

        return $budgetSource->amount - $budgetSource->amountToBeSubtracted;
    }

    public function returnLatestRegNo(plan $plan)
    {
        $reg_no = $plan->latest()->first();
        return  $reg_no == null ? 1 : $reg_no->reg_no;
    }

    public function returnKharchType(string $param)
    {
        $kharch_type = "";
        if ($param == null) {
            return '';
        }
        switch ($param) {
            case 'p':
                $kharch_type = config('constant.PUJIGAT_KHARCHA');
                break;
            default:
                $kharch_type = config('constant.CHALU_KHARCHA');
                break;
        }
        return $kharch_type;
    }
}
