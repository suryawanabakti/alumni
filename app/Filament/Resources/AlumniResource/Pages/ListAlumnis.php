<?php

namespace App\Filament\Resources\AlumniResource\Pages;

use App\Filament\Resources\AlumniResource;
use App\Imports\UsersImport;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;

class ListAlumnis extends ListRecords
{
    protected static string $resource = AlumniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import_users')
                ->label('Import Users')
                ->modalDescription(new HtmlString('Silahkan download template <a href="' . route('download.users.template') . '" class="text-primary-600 hover:text-primary-500 font-medium" target="_blank">disini</a>'))
                ->form([
                    FileUpload::make('file')
                        ->label('Excel File')
                        ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                        ->required(),
                ])
                ->action(function (array $data): void {
                    Excel::import(new UsersImport, $data['file']);
                }),
            Actions\Action::make('export_excel')
                ->label('Export Excel')
                ->url('/alumni/report/excel', shouldOpenInNewTab: false),
        ];
    }
}
