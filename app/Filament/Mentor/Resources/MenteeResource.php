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

    protected static ?string $navigationIcon = 'heroicon-m-users';
    protected static ?string $navigationLabel = 'Daftar Mentee';
    protected static ?string $pluralLabel = 'Mentees';
    protected static ?string $modelLabel = 'Mentee';

    public static function canCreate(): bool
    {
        return Filament::getCurrentPanel()->getId() === 'admin';
    }

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->height(40),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
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

    public static function getPluralModelLabel(): string
    {
        return 'Mentee';
    }
}
