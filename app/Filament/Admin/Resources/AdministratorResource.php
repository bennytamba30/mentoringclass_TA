<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\AdministratorResource\Pages;
use App\Filament\Admin\Resources\AdministratorResource\RelationManagers;

class AdministratorResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = '👤 Manajemen User';
    protected static ?string $label = 'Administrator';
    protected static ?string $pluralLabel = '';

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

            Forms\Components\TextInput::make('nim')
                ->label('NIM')
                ->numeric() // hanya angka
                ->minLength(10)
                ->maxLength(10)
                ->rules(['digits:10'])
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('kelas')
                ->label('Kelas')
                ->maxLength(50),

            Forms\Components\Select::make('role')
                ->label('Role')
                ->options([
                    'admin' => 'Admin',
                    'mentor' => 'Mentor',
                    'mentee' => 'Mentee',
                ])
                ->default('admin')
                ->required()
                ->disabled()
                ->dehydrated(),



            Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                ->revealable()
                ->required(fn (string $context): bool => $context === 'create')
                ->minLength(6)
                ->dehydrateStateUsing(fn (string $state): string => bcrypt($state))
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->maxLength(255),

            Forms\Components\FileUpload::make('photo')
                ->label('Foto')
                ->image()
                ->maxSize(2048) // 2MB
                ->directory('photos')
                ->visibility('public')
                ->previewable(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('role', 'admin'); // Hanya tampilkan user dengan role 'admin'
            })
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('nim')
                    ->label('NIM'),
                TextColumn::make('kelas')
                    ->label('Kelas'),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')->badge(),

              ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->height(40)
                    ->width(40)
                    ->defaultImageUrl(asset('storage/default-avatar.png')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPluralModelLabel(): string
    {
        return 'Administrator';
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
            'index' => Pages\ListAdministrators::route('/'),
            'create' => Pages\CreateAdministrator::route('/create'),
            'edit' => Pages\EditAdministrator::route('/{record}/edit'),
        ];
    }


}
