<?php

namespace App\Filament\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question_text')
                    ->required()
                    ->maxLength(255)->columnSpanFull(),
                Forms\Components\Select::make('question_type')
                    ->columnSpanFull()
                    ->label('Question Type')
                    ->options([
                        'text' => 'Text',
                        'date' => 'Date',
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

    // protected function handleRecordCreation(array $data): Model
    // {
    //     dd($data);
    // }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                Tables\Columns\TextColumn::make('question_text'),
                Tables\Columns\TextColumn::make('question_type'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
