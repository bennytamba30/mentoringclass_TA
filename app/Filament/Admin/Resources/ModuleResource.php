<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ModuleResource\Pages;
use App\Filament\Admin\Resources\ModuleResource\RelationManagers;
use App\Models\Module;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'title')
                    ->label('Course')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('content')
                    ->required()
                    ->rows(5),

                Forms\Components\FileUpload::make('file_path')
                    ->label('File Materi (Opsional)')
                    ->directory('modules')
                    ->preserveFilenames()
                    ->downloadable()
                    ->nullable(),
            ]);
    }

        public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('Module ID'),

                Tables\Columns\TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created'),

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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}
