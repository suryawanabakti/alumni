<?php

namespace App\Filament\Resources\InformasiBeasiswaResource\Pages;

use App\Filament\Resources\InformasiBeasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInformasiBeasiswas extends ListRecords
{
    protected static string $resource = InformasiBeasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
