<?php

namespace App\Filament\Mentor\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
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
            TextInput::make('title')
                ->label('Judul Tugas')
                ->required(),

            Textarea::make('description')
                ->label('Deskripsi')
                ->nullable(),

            DateTimePicker::make('deadline') // ✅ tambahkan ini
                ->label('Deadline')
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Judul Tugas')->searchable(),
            TextColumn::make('description')->limit(50),
            TextColumn::make('deadline')->label('Deadline')->dateTime(),
            TextColumn::make('created_at')->since()->label('Dibuat'),
        ])->headerActions([
            CreateAction::make(),
        ])->actions([
            EditAction::make(),
            DeleteAction::make(),
        ]);
    }
}

