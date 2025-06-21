<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\CourseResource\Pages;
use App\Filament\Mentor\Resources\CourseResource\RelationManagers\ModulesRelationManager;
use App\Filament\Mentor\Resources\CourseResource\RelationManagers\AssignmentsRelationManager;
use App\Models\Course;
use App\Models\Meeting;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = '📆 Pertemuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('mentor_id')->default(Filament::auth()->id()),

                Select::make('meeting_id')
                    ->label('Pertemuan')
                    ->relationship('meeting', 'title')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Judul Course')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->nullable(),
            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['mentor_id'] = Filament::auth()->id();
        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('meeting.title')->label('Pertemuan'),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable(),
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
            // kamu bisa tambahkan AttendanceRelationManager jika absensi by course
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
            ->where('mentor_id', Filament::auth()->id());
    }
}
