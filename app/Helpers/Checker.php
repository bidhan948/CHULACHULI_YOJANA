<?php

namespace App\Helpers;

class Checker
{

    public function checkFemalePercent($gender = [])
    {
        $totalGenderCount = count($gender);
        $femaleGenderCount = 0;
        foreach ($gender as  $gender) {
            if ($gender == 'female') {
                $femaleGenderCount++;
            }
        }
        if (0.33 * $totalGenderCount > $femaleGenderCount) {
            return true;
        } else {
            return false;
        }
    }

}
