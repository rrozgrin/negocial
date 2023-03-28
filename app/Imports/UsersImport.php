<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name_user' => $row['0'],
            'gecobi' => $row['1'],
            'role' => $row['2'],
            'password' => Hash::make($row['3']),
        ]);
    }
}
