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
use Filament\Tables\Columns\ImageColumn;

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
                ]),

            Forms\Components\Select::make('mentor_id')
                ->label('Mentor')
                ->relationship('mentor', 'name')
                ->visible(fn ($get) => $get('role') === 'mentee')
                ->required(fn ($get) => $get('role') === 'mentee'),

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
            ->modifyQueryUsing(fn (Builder $query) =>
                $query->whereIn('role', ['mentor', 'mentee'])
            )
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                 TextColumn::make('nim')
                    ->label('NIM'),
    
                TextColumn::make('kelas')
                    ->label('Kelas'),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('role')
                    ->badge(),

                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->height(40)
                    ->width(40)
                    ->defaultImageUrl(asset('storage/default-avatar.png')),

                 TextColumn::make('mentor.name')
                    ->label('Mentor')
                    ->default('-')
                    ->formatStateUsing(fn ($state, $record) =>
                    $record->role === 'mentee' && $record->mentor ? $record->mentor->name : '-'
                    ),

            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter by Role')
                    ->options([
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

    /**
   
     *
     * @return Builder
     */
       return parent::getEloquentQuery()
            ->with('mentor');
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
