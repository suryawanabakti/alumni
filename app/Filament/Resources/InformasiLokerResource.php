<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiLokerResource\Pages;
use App\Filament\Resources\InformasiLokerResource\RelationManagers;
use App\Models\InformasiLoker;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformasiLokerResource extends Resource
{
    protected static ?string $model = InformasiLoker::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Informasi Loker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('gambar'),
                TextInput::make('perusahaan'),
                Select::make('jenis')->options([
                    'Full Time' => 'Full Time',
                    'Paruh waktu' => 'Paruh waktu',
                    'Kontrak' => 'Kontrak',
                    'Kasual' => 'Kasual',
                ]),
                TextInput::make('alamat'),
                TextInput::make('judul'),
                RichEditor::make('description')->nullable()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->searchable(),
                TextColumn::make('perusahaan')->searchable(),
                TextColumn::make('jenis')->searchable(),
                TextColumn::make('alamat')->searchable()->wrap(),
                TextColumn::make('description')->label('Deskripsi')->searchable()->html()->wrap(),
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
            'index' => Pages\ListInformasiLokers::route('/'),
            'create' => Pages\CreateInformasiLoker::route('/create'),
            'edit' => Pages\EditInformasiLoker::route('/{record}/edit'),
        ];
    }
}
