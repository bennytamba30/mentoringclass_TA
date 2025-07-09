<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DocumentationResource\Pages;
use App\Models\Documentation;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class DocumentationResource extends Resource
{
    protected static ?string $model = Documentation::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Dokumentasi';
    protected static ?string $navigationGroup = '📊 Laporan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('meeting_id')
                ->label('Pertemuan')
                ->relationship('meeting', 'title')
                ->required()
                ->disabled(),

            Forms\Components\Select::make('mentor_id')
                ->label('Mentor')
                ->relationship('mentor', 'name')
                ->required()
                ->disabled(),

            Forms\Components\FileUpload::make('image_path')
                ->label('Foto Dokumentasi')
                ->image()
                ->directory('documentations')
                ->visibility('public')
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Foto')
                    ->height(100)
                    ->width(100)
                    ->disk('public')
                    ->circular()
                    ->openUrlInNewTab()
                    ->url(fn ($record) => asset('storage/' . $record->image_path)),
                TextColumn::make('meeting.title')
                    ->label('Pertemuan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mentor.name')
                    ->label('Mentor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Diunggah')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('meeting_id')
                    ->label('Filter Pertemuan')
                    ->relationship('meeting', 'title')
                    ->searchable(),
            ])
                        ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => route('admin.documentation.download', basename($record->image_path)))
                    ->openUrlInNewTab(false),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentations::route('/'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['meeting', 'mentor']);
    }

    public static function getPluralModelLabel(): string
    {
        return 'Dokumentasi';
    }
}
