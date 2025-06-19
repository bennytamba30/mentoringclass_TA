<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\CourseResource\Pages;
use App\Filament\Mentor\Resources\CourseResource\RelationManagers\ModulesRelationManager;
use App\Filament\Mentor\Resources\CourseResource\RelationManagers\AssignmentsRelationManager;
use App\Filament\Mentor\Resources\CourseResource\RelationManagers\AttendancesRelationManager;
use App\Models\Course;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Hidden;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = '📚 My Courses';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Hidden::make('mentor_id')->default(Filament::auth()->id()),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description')->nullable(),
            ])
            ->columns(1);

    }
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['mentor_id'] = Filament::auth()->id(); // isi otomatis
        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->since(),
            ])
            ->filters([])
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
            ModulesRelationManager::class,
            AssignmentsRelationManager::class,
            AttendancesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            // ->where('mentor_id', auth()->user()->mentor->id);
            ->where('mentor_id', auth()->id());
    }
}
