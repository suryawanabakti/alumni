<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Filament\Resources\FormResource\RelationManagers;
use App\Filament\Resources\FormResource\RelationManagers\QuestionsRelationManager;
use App\Models\Form as FormForm;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormResource extends Resource
{
    protected static ?string $model = FormForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?int $navigationSort = -2;
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationName = 'Kuesioner';
    protected static ?string $modelLabel = 'Kuesioner';
    protected static ?string $pluralModelLabel = 'Kuesioner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
            ])
            ->filters([
                //
            ])
            ->actions([
                // Action mengahrahkan ke tab baru /report/1
                Action::make('view_report')
                    ->label('View Report')
                    ->url(fn($record) => url("/report/{$record->id}"))
                    ->openUrlInNewTab(), // Membuka di tab baru
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
            QuestionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
