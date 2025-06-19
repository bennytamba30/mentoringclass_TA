<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\MenteeResource\Pages;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;

class MenteeResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Mentees';
    protected static ?string $pluralLabel = 'Mentees';
    protected static ?string $modelLabel = 'Mentee';


    public static function canCreate(): bool
    {
        return Filament::getCurrentPanel()->getId() === 'admin';
    }

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        // Form tidak diperlukan di panel mentor (hanya lihat data)
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('User ID'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('created_at')->label('Registered')->dateTime(),
            ])
            ->filters([])
            ->actions([]) // Hapus Edit/Delete dari sisi mentor
            ->bulkActions([]); // Tidak perlu aksi bulk juga
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'mentee')
            ->where('mentor_id', auth()->id());
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMentees::route('/'),
        ];
    }
}
