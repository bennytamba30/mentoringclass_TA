<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class DocumentationDownloadController extends Controller
{
    public function download($filename)
    {
        $path = 'documentations/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File dokumentasi tidak ditemukan.');
        }

        $ext = Str::afterLast($filename, '.');
        $downloadName = 'dokumentasi_' . now()->format('Ymd_His') . '.' . $ext;

        return Storage::disk('public')->download($path, $downloadName);
    }
}
