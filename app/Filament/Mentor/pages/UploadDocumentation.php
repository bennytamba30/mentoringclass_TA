<?php

namespace App\Filament\Mentor\Pages;

use App\Models\Documentation;
use App\Models\Meeting;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class UploadDocumentation extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Upload Dokumentasi';
    protected static string $view = 'filament.mentor.pages.upload-documentation';
    protected static ?string $title = 'Upload Dokumentasi';

    public ?int $meeting_id = null;
    public $photo;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('meeting_id')
                ->label('Pilih Pertemuan')
                ->options(Meeting::orderByDesc('date')->pluck('title', 'id'))
                ->required(),

            Forms\Components\FileUpload::make('photo')
                ->label('Foto Dokumentasi')
                ->image()
                ->required()
                ->directory('documentations')
                ->visibility('public')
                ->imagePreviewHeight('250')
                ->imageEditor()
                ->imageCropAspectRatio('16:9')
                ->imageResizeTargetWidth('1280')
                ->imageResizeTargetHeight('720'),
        ];
    }

   public function submit(): void
    {
        $data = $this->form->getState();

        Documentation::create([
            'meeting_id' => $data['meeting_id'],
            'mentor_id' => Auth::id(),
            'image_path' => $data['photo'],
        ]);

        Notification::make()
            ->title('Dokumentasi berhasil diunggah')
            ->success()
            ->send();

        // Reset semua nilai dan form
        $this->reset('meeting_id', 'photo');
        $this->form->fill();
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('submit')
                ->label('Upload')
                ->submit('submit')
                ->color('primary'),
        ];
    }
}
