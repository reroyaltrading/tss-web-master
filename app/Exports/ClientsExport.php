<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;


class ClientsExport implements FromArray
{
    protected $clients;

    public function __construct(array $clients)
    {
        $this->clients = $clients;
    }

    public function array(): array
    {
        return $this->clients;
    }

    public function collection()
    {
        return $this->clients;
    }
}