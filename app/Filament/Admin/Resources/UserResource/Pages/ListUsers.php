<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableColumns(): array
    {
        $columns = [
            TextColumn::make('id')->sortable()->label('User ID'),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('role')->badge(),
            TextColumn::make('status')->badge(),
            TextColumn::make('created_at')->label('Registered')->dateTime(),
        ];

        $filters = $this->getTable()->getFiltersState();

        if (($filters['role'] ?? null) === 'mentee') {
            $columns[] = TextColumn::make('mentor.name')
                ->label('Mentor')
                ->default('-');
        }

        return $columns;
    }
}
