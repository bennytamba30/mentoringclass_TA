<?php

namespace App\Filament\Mentor\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Announcement;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use App\Filament\Mentor\Resources\AnnouncementResource\Pages;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?string $pluralLabel = 'Pengumuman';
    protected static ?string $navigationGroup = '📢 Informasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Hidden::make('mentor_id')
                ->default(fn () => Auth::id()),

            Forms\Components\TextInput::make('title')
                ->label('Judul')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('content')
                ->label('Isi Pengumuman')
                ->required()
                ->rows(5),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('content')
                    ->label('Isi')
                    ->limit(50)
                    ->wrap()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }

    

    
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['mentor_id'] = Auth::id();
        return $data;
    }

    
    public static function mutateFormDataBeforeSave(array $data): array
    {
        $data['mentor_id'] = Auth::id();
        return $data;
    }

    
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('mentor_id', Auth::id());
    }
}
