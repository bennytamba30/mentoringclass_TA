<?php

namespace App\Filament\Admin\Resources\DocumentationResource\Pages;

use App\Filament\Admin\Resources\DocumentationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentations extends ListRecords
{
    protected static string $resource = DocumentationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
