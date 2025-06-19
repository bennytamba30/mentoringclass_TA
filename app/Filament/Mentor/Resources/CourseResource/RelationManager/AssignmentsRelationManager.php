<?php

namespace App\Filament\Mentor\Resources\CourseResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class AssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignments';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required(),
            Textarea::make('description')->required(),
            DatePicker::make('deadline')->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('deadline')->date(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
