<?php

namespace App\Filament\Mentor\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Mentor\Widgets\MentorStats;

class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            MentorStats::class,
        ];
    }
}
