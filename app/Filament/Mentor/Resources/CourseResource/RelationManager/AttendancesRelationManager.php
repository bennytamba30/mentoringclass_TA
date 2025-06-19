<?php

namespace App\Filament\Mentor\Resources\CourseResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class AttendancesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendances';

    public function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('meeting_date')->label('Meeting Date')->required(),
            Textarea::make('notes')->label('Notes')->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('meeting_date')->date(),
                TextColumn::make('notes')->limit(50),
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
