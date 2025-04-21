<?php

namespace App\Filament\Resources\AlumniResource\Pages;

use App\Filament\Resources\AlumniResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlumnis extends ListRecords
{
    protected static string $resource = AlumniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // Actions\Action::make('export_pdf')->label('Export PDF')->url('/alumni/report', shouldOpenInNewTab: true),
            Actions\Action::make('export_excel')->label('Export Excel')->url('/alumni/report/excel', shouldOpenInNewTab: false),
        ];
    }
}
