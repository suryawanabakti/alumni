<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersImportTemplate implements FromArray, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'name',
            'username',
            'nama_ayah',
            // Add other fields as needed
        ];
    }

    public function array(): array
    {
        // Return an empty array or sample data
        return [
            // Optional: Add a sample row
            ['John Junior', '512521512', 'John'],
        ];
    }
}
