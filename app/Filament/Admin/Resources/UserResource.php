<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $navigationGroup = '👤 Manajemen User';
    protected static ?string $navigationLabel = 'User';
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
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
                ->relationship('mentor', 'name')
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
        $isMenteeFiltered = data_get(request()->query('tableFilters'), 'role.value') === 'mentee';

        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('User ID'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')->badge(),
                TextColumn::make('status')->badge(),
                TextColumn::make('created_at')->label('Registered')->dateTime(),

               TextColumn::make('mentor.name')
                ->label('Mentor')
                ->visible(fn () => data_get(request()->query('tableFilters'), 'role.value') === 'mentee')
                ->default('-'),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter by Role')
                    ->options([
                        'admin' => 'Admin',
                        'mentor' => 'Mentor',
                        'mentee' => 'Mentee',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getEloquentQuery(): Builder
{
    $isMenteeFiltered = data_get(request()->query('tableFilters'), 'role.value') === 'mentee';

    return parent::getEloquentQuery()
        ->when($isMenteeFiltered, fn ($query) => $query->with('mentor'));
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
