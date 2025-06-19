<?php

namespace App\Filament\Admin\Resources;

use App\Models\Course;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Filament\Admin\Resources\CourseResource\Pages;
use App\Filament\Admin\Resources\CourseResource\RelationManagers\ModulesRelationManager;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->rows(4)
                ->columnSpanFull(),
            Select::make('mentor_id')
                ->label('Mentor')
                ->relationship('mentor', titleAttribute:'name')
                ->options(
                \App\Models\User::where('role', 'mentor')->pluck('name', 'id')
    )
                ->searchable()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('mentor.name')->label('Mentor'),
                TextColumn::make('created_at')->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // public static function getRelations(): array
    // {
    //     return [
    //         ModulesRelationManager::class,
    //     ];
    // }  

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
