<?php

namespace App\Filament\Admin\Resources;

use App\Models\Attendance;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use App\Models\Mentee;
use App\Models\Meeting;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Admin\Resources\AttendanceResource\Pages;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Laporan Absensi';
    protected static ?string $navigationGroup = '📊 Laporan';
    protected static ?string $label = 'Absensi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('meeting_id')
                ->relationship('meeting', 'title')
                ->label('Pertemuan')
                ->required(),
                

            Select::make('mentee_id')
                ->relationship('mentee', 'name')
                ->label('Mentee')
                ->required(),

            Select::make('status')
                ->options([
                    'hadir' => '✅ Hadir',
                    'izin' => '🟡 Izin',
                    'sakit' => '🔵 Sakit',
                    'alfa' => '❌ Alfa',
                ])
                ->required(),

            TextInput::make('note')->label('Catatan')->nullable(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('meeting.title')
            ->label('Pertemuan')
            ->sortable(),
            TextColumn::make('mentee.name')->label('Mentee'),
            TextColumn::make('mentee.mentor.name') // asumsi relasi mentee → mentor → name
                ->label('Mentor'),
            TextColumn::make('status')->label('Status')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'hadir' => 'success',
                    'izin' => 'warning',
                    'sakit' => 'info',
                    'alfa' => 'danger',
                    default => 'gray',
                }),
            TextColumn::make('note')->label('Catatan'),
            TextColumn::make('created_at')->label('Waktu Input')->dateTime(),

            
        ])
         ->filters([
            Tables\Filters\SelectFilter::make('meeting_id')
                ->label('Filter Pertemuan')
                ->relationship('meeting', 'title')
         ])

                ->headerActions([
    Action::make('Download PDF')
        ->url(function () {
            $filters = request()->input('tableFilters', []);
            $meetingId = $filters['meeting_id']['value'] ?? null;

            return route('admin.attendance-report.pdf', array_filter([
                'meeting_id' => $meetingId,
            ]));
        })
        ->label('Download PDF')
        ->icon('heroicon-o-arrow-down-tray')
        ->openUrlInNewTab()
])



        ->defaultSort('created_at', 'desc')
        ->searchable();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

      public static function getPluralModelLabel(): string
    {
        return 'Laporan Absensi';
    }

}
