<?php

namespace App\Imports;

use App\Models\Admin\Reimbursement as AdminReimbursement;
use Maatwebsite\Excel\Concerns\ToModel;

class ReimbursementImports implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AdminReimbursement([]);
    }
}
