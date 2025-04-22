<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Filament\Resources\AlumniResource\RelationManagers;
use App\Filament\Resources\AlumniResource\RelationManagers\ResponsesRelationManager;
use App\Models\Alumni;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlumniResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Laporan Alumni';
    // protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $modelLabel = 'Laporan Alumni';
    protected static ?string $pluralModelLabel = 'Laporan Alumni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar'),
                TextInput::make('name'),
                TextInput::make('ipk')->numeric(),
                Select::make('prodi')->options([
                    "Teknik Informatika" => "Teknik Informatika",
                    "Sistem Informasi" => "Sistem Informasi",
                    "Bisnis Digital" => "Bisnis Digital",
                    "Teknologi Informasi" => "Teknologi Informasi",
                ]),
                Textarea::make('skill'),
                Textarea::make('organisasi'),
                TextInput::make('angkatan')->numeric()->minLength(4),
                TextInput::make('no_telp'),
                TextInput::make('username')->unique(ignoreRecord: true)->label('NIM'),
                // TextInput::make('tahun_ajaran'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::role('alumni'))
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('username')->searchable(),
                TextColumn::make('nama_ayah')->searchable(),
                // TextColumn::make('email')->searchable(),
                TextColumn::make('ipk')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
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
            ResponsesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlumnis::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit' => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
