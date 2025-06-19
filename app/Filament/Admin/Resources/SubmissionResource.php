<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('assignment_id')
                    ->relationship('assignment', 'title')
                    ->required(),

                Forms\Components\Select::make('mentee_id')
                    ->relationship('mentee.user', 'name')
                    ->label('Mentee Name')
                    ->required(),

                Forms\Components\FileUpload::make('file_path')
                    ->label('Submission File')
                    ->required()
                    ->directory('submissions')
                    ->downloadable()
                    ->preserveFilenames(),

                Forms\Components\TextInput::make('grade')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->label('Grade')
                    ->nullable(),

                Forms\Components\Textarea::make('feedback')
                    ->label('Feedback')
                    ->rows(4)
                    ->nullable(),

                Forms\Components\DateTimePicker::make('submitted_at')
                    ->label('Submitted At')
                    ->required()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('Submission ID'),

                Tables\Columns\TextColumn::make('assignment.title')
                    ->label('Assignment')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mentee.user.name')
                    ->label('Mentee')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('grade')
                    ->label('Grade'),

                Tables\Columns\TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->label('Last Updated'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmission::route('/create'),
            'edit' => Pages\EditSubmission::route('/{record}/edit'),
        ];
    }
}

