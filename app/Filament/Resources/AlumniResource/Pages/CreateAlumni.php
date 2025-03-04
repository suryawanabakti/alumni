<?php

namespace App\Filament\Resources\AlumniResource\Pages;

use App\Filament\Resources\AlumniResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAlumni extends CreateRecord
{
    protected static string $resource = AlumniResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['name'] = $data['name'];
        $data['password'] = bcrypt($data['username']);
        $data['email'] = $data['username'] . '@example.com';

        return static::getModel()::create($data)->assignRole('alumni');
    }
}
