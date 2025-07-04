<?php

namespace App\Filament\Mentor\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\RelationManagers\RelationManager;

class AssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Tugas')
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required(),

                DateTimePicker::make('deadline') // ✅ ganti dari DatePicker ke DateTimePicker
                    ->label('Deadline')
                    ->seconds(false) // sembunyikan detik, cukup sampai menit
                    ->required(),   // jika perlu, bisa diubah ke ->nullable()

                FileUpload::make('attachment')
                    ->label('File')
                    ->directory('assignments')
                    ->preserveFilenames()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ])
                    ->required(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Judul Tugas')->searchable(),
            TextColumn::make('description')->limit(50)->label('Deskripsi'),
            TextColumn::make('deadline')->label('Deadline')->dateTime(), // ✅ tampilkan jam & tanggal

            TextColumn::make('attachment')
                ->label('File')
                ->formatStateUsing(fn ($state) => $state ? '📄 ' . basename($state) : 'Tidak ada')
                ->url(fn ($record) => $record->attachment ? asset('storage/' . $record->attachment) : null)
                ->openUrlInNewTab()
                ->color('primary'),

            TextColumn::make('created_at')->since()->label('Dibuat'),
        ])->headerActions([
            CreateAction::make(),
        ])->actions([
            EditAction::make(),
            DeleteAction::make(),
        ]);
    }
}
