<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return       $user =  User::create([
            'name'     => $row['name'],
            'email'    => $row['username'],
            'username'    => $row['username'],
            'password' => Hash::make($row['nama_ayah'] ?? 'password123'),
            'nama_ayah' => $row['nama_ayah'],
            // Add other fields as needed
        ])->assignRole('alumni');
    }
}
