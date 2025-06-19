<?php

namespace App\Filament\Mentor\Resources\CourseResource\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required(),
            Textarea::make('content')->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('content')->limit(50),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
