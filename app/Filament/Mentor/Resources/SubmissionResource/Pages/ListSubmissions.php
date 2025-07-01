<?php

namespace App\Filament\Mentor\Resources\SubmissionResource\Pages;

use App\Filament\Mentor\Resources\SubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmissions extends ListRecords
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
