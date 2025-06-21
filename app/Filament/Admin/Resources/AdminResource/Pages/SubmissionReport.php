<?php

namespace App\Filament\Admin\Resources\AdminResource\Pages;

use Filament\Pages\Page;
use App\Models\Submission;

class SubmissionReport extends Page
{
    protected static string $view = 'filament.admin.resources.admin-resource.pages.submission-report';

    public $submissions;

    public function mount(): void
    {
        $this->submissions = Submission::with(['mentee', 'assignment.course'])->latest()->get();
    }

    protected static ?string $navigationGroup = '📊 Laporan';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Tugas';
    protected static ?string $slug = 'laporan-tugas';
    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
