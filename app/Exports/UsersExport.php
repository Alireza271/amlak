<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

   public $list;
    public function __construct($list)
    {
        $this->list=$list;
    }

    public function collection()
    {
        return $this->list;
    }

    public function query()
    {
        return $this->list;

    }
}
