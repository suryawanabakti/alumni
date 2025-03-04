<?php

namespace App\Filament\Resources\AlumniResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResponsesRelationManager extends RelationManager
{
    protected static string $relationship = 'responses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question.question_text')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question.question_text')
            ->columns([
                Tables\Columns\TextColumn::make('question.form.judul')->searchable(),
                Tables\Columns\TextColumn::make('question.question_text')->searchable(),
                Tables\Columns\TextColumn::make('answer')->searchable(),
            ])
            ->filters([
                SelectFilter::make('form_id')
                    ->label('Filter Berdasarkan Judul Form')
                    ->options(fn() => \App\Models\Form::pluck('judul', 'id')->toArray()) // Ambil data dari tabel form
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
