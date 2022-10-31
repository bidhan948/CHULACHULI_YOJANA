<?php

namespace App\Imports;

use App\Models\plan;
use Maatwebsite\Excel\Concerns\ToModel;

class PlanImport implements ToModel
{

    public function title(): string
    {
        return 'yojana';
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new plan([
            //
        ]);
    }
}
