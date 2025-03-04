<?php

namespace App\Filament\Resources\InformasiLokerResource\Pages;

use App\Filament\Resources\InformasiLokerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformasiLoker extends EditRecord
{
    protected static string $resource = InformasiLokerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
