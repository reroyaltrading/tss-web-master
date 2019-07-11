<?php

namespace App\Imports;

use App\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ClientsImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return new Client([
            'name' => $row[0], 
            'phone' => $row[1], 
            'city' => $row[2], 
            'state_province' => $row[3],
            'postal_code' => $row[4],
            'optional_code' => $row[5], 
            'email' => $row[6],
            'description' => $row[7]
        ]);
    }
}