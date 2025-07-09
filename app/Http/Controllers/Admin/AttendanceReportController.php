<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AttendanceReportController extends Controller
{
    public function download(Request $request)
{
    $meetingId = $request->input('meeting_id');

    $attendances = Attendance::with(['mentee.mentor', 'meeting'])
        ->when($meetingId, fn($query) => $query->where('meeting_id', $meetingId))
        ->latest()
        ->get();

    $pdf = Pdf::loadView('admin.reports.attendance-pdf', compact('attendances'));


    $filename = 'laporan-absensi' . ($meetingId ? "-pertemuan-$meetingId" : '-semua') . '.pdf';

    return $pdf->download($filename);
}

}