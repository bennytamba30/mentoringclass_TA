<?php

namespace App\Filament\Mentor\Resources\CourseResource\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Str;

class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul Modul')
                ->required(),

            Textarea::make('content')
                ->label('Deskripsi')
                ->required(),

            FileUpload::make('file_path')
                ->label('File Modul (PDF/DOCX)')
                ->directory('modul-files')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ])
                ->nullable(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul'),
                TextColumn::make('content')->limit(50)->label('Deskripsi'),

                TextColumn::make('file_path')
                    ->label('Nama File')
                    ->formatStateUsing(fn ($state) => $state ? '📄 ' . basename($state) : 'Tidak ada')
                    ->url(fn ($record) => $record && $record->file_path ? asset('storage/' . $record->file_path) : null)
                    ->openUrlInNewTab()
                    ->color('primary'),

                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),

                // ✅ Preview PDF Modal
                Action::make('preview')
                    ->label('Preview PDF')
                    ->icon('heroicon-o-eye')
                    ->visible(fn ($record) => $record && filled($record->file_path) && Str::endsWith($record->file_path, '.pdf'))
                    ->modalHeading('Preview Modul PDF')
                    ->modalContent(fn ($record) => view('components.module-preview', ['record' => $record]))
                    ->modalWidth('4xl'),

                // ✅ Download File
                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => $record && $record->file_path ? asset('storage/' . $record->file_path) : '#')
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record && filled($record->file_path)),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
