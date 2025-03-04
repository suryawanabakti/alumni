<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('form_id')
                    ->label('Form')
                    ->options(fn() => \App\Models\Form::pluck('judul', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('question_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('question_type')
                    ->columnSpanFull()
                    ->label('Question Type')
                    ->options([
                        'text' => 'Text',
                        'radio' => 'Radio',
                        'checkbox' => 'Checkbox',
                    ])
                    ->reactive(),
                Forms\Components\Repeater::make('options')
                    ->label('Options')
                    ->schema([
                        Forms\Components\TextInput::make('option')
                            ->label('Option')
                            ->required()
                    ])
                    ->hidden(fn(callable $get) => !in_array($get('question_type'), ['radio', 'checkbox']))
                    ->minItems(1)
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question_text'),
                Tables\Columns\TextColumn::make('question_type'),

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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
