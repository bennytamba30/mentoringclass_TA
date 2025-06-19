<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
public static function form(Form $form): Form
{
    return $form 
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->unique(ignoreRecord: true),

           Forms\Components\Select::make('role')
            ->label('Role')
            ->required()
            ->native()
            ->reactive()
            ->options([
                'admin' => 'Admin',
                'mentor' => 'Mentor',
                'mentee' => 'Mentee',
            ])
            ->default('mentee'),

            Forms\Components\Select::make('mentor_id')
            ->label('Mentor')
            ->relationship('mentor', 'name') // sesuai relasi belongsTo
            ->visible(fn ($get) => $get('role') === 'mentee')
            ->required(fn ($get) => $get('role') === 'mentee'),


            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->default('active'),


            Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(fn (string $context): bool => $context === 'create')
                ->minLength(6)
                ->dehydrateStateUsing(fn (string $state): string => bcrypt($state))
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->maxLength(255),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->sortable()->label('User ID'),
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('role')->badge(),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('created_at')->label('Registered')->dateTime(),
            Tables\Columns\TextColumn::make('mentor.name')
                ->label('Mentor')
                ->visible(fn ($record) => $record?->role === 'mentee' && $record->mentor !== null),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
