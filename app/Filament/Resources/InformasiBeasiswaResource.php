<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiBeasiswaResource\Pages;
use App\Filament\Resources\InformasiBeasiswaResource\RelationManagers;
use App\Models\InformasiBeasiswa;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformasiBeasiswaResource extends Resource
{
    protected static ?string $model = InformasiBeasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Informasi Beasiswa';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('gambar'),
                TextInput::make('judul'),
                RichEditor::make('description')->nullable()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->searchable(),
                TextColumn::make('description')->html()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformasiBeasiswas::route('/'),
            'create' => Pages\CreateInformasiBeasiswa::route('/create'),
            'edit' => Pages\EditInformasiBeasiswa::route('/{record}/edit'),
        ];
    }
}
