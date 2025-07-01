<?php

namespace App\Filament\Mentor\Resources;

use App\Models\Submission;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Mentor\Resources\SubmissionResource\Pages\ListSubmissions;
use App\Filament\Mentor\Resources\SubmissionResource\Pages\EditSubmission;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationLabel = 'Pengumpulan Tugas';
    protected static ?string $navigationGroup = '📊 Laporan';
    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('score')
                ->label('Nilai')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->required(),

            Forms\Components\Textarea::make('feedback')
                ->label('Feedback')
                ->rows(4)
                ->maxLength(1000),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) =>
                $query->whereHas('assignment.course', fn ($q) =>
                    $q->where('mentor_id', auth()->id())
                )
            )
            ->columns([
                TextColumn::make('mentee.name')
                    ->label('Mentee')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('assignment.course.title')
                    ->label('Kursus')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('assignment.title')
                    ->label('Tugas')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('submitted_at')
                    ->label('Tanggal Submit')
                    ->dateTime(),

                TextInputColumn::make('score')
                    ->label('Nilai')
                    ->rules(['nullable', 'numeric', 'between:0,100'])
                    ->afterStateUpdated(function ($record, $state) {
                        $record->score = $state;
                        $record->save();

                        Notification::make()
                            ->title('Nilai berhasil diperbarui.')
                            ->success()
                            ->send();
                    }),

                TextInputColumn::make('feedback')
                    ->label('Feedback')
                    ->rules(['nullable', 'max:1000'])
                    ->afterStateUpdated(function ($record, $state) {
                        $record->feedback = $state;
                        $record->save();

                        Notification::make()
                            ->title('Feedback berhasil diperbarui.')
                            ->success()
                            ->send();
                    }),

                TextColumn::make('file')
                    ->label('File Tugas')
                    ->url(fn ($record) => asset('storage/' . $record->file))
                    ->openUrlInNewTab()
                    ->limit(20),
            ])
            ->filters([
               SelectFilter::make('assignment_id')
                ->label('Filter Tugas')
                ->relationship('assignment', 'title')
                ->searchable(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->defaultSort('submitted_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubmissions::route('/'),
            'edit' => EditSubmission::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['mentee', 'assignment.course'])
            ->whereHas('assignment.course', fn ($q) =>
                $q->where('mentor_id', auth()->id())
            );
    }
}
