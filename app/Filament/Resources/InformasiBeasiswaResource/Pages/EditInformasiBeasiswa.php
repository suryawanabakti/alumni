<?php

namespace App\Filament\Resources\InformasiBeasiswaResource\Pages;

use App\Filament\Resources\InformasiBeasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformasiBeasiswa extends EditRecord
{
    protected static string $resource = InformasiBeasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
