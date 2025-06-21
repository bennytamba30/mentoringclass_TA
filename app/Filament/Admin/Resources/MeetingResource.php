<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MeetingResource\Pages;
use App\Filament\Admin\Resources\MeetingResource\RelationManagers\CoursesRelationManager;
use App\Models\Meeting;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = '📆 Pertemuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Judul Pertemuan')->required(),
                Forms\Components\DatePicker::make('date')->label('Tanggal Pertemuan')->required(),
                Forms\Components\Textarea::make('description')->label('Deskripsi')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->since(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    // public static function getRelations(): array
    // {
    //     return [
    //         CoursesRelationManager::class, // Melihat daftar course dalam meeting ini
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeeting::route('/create'),
            'edit' => Pages\EditMeeting::route('/{record}/edit'),
        ];
    }
}
