<?php

namespace App\Filament\Mentor\Resources\AnnouncementResource\Pages;

use App\Filament\Mentor\Resources\AnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;
}
