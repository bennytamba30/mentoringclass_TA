<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use App\Models\Meeting;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = '📆 Pertemuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('meeting_id')
                    ->label('Pertemuan')
                    ->relationship('meeting', 'title')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('mentee_id')
                    ->label('Mentee')
                    ->options(
                        User::where('role', 'mentee')->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status Kehadiran')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alfa' => 'Alfa',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->label('Catatan (Opsional)')
                    ->rows(2)
                    ->maxLength(255)
                    ->nullable(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('meeting.title')
                    ->label('Pertemuan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('mentee.name')
                    ->label('Mentee')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'hadir',
                        'warning' => 'izin',
                        'info' => 'sakit',
                        'danger' => 'alfa',
                    ]),

                Tables\Columns\TextColumn::make('note')->limit(30),
                Tables\Columns\TextColumn::make('created_at')->label('Waktu Input')->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Hanya tampilkan absensi yang dibuat mentor ini (jika perlu)
        return parent::getEloquentQuery();
    }
}
