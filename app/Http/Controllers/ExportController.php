<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pengumpulan;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function exportGrades($kelasId)
    {
        // Verify the user is the teacher of this class
        $kelas = Kelas::findOrFail($kelasId);
        
        if ($kelas->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke kelas ini.');
        }

        // Get all students in the class and their assignment submissions
        $students = $kelas->siswa()->with(['pengumpulan' => function($query) use ($kelasId) {
            $query->whereHas('tugas', function($subQuery) use ($kelasId) {
                $subQuery->where('kelas_id', $kelasId);
            })->with('tugas');
        }])->get();

        // Get all assignments for this class
        $assignments = $kelas->tugas()->get();

        // Generate CSV content
        $headers = ['Nama Siswa'];
        foreach ($assignments as $assignment) {
            $headers[] = $assignment->judul;
        }
        $headers[] = 'Rata-rata';

        $csvContent = '"' . implode('","', $headers) . '"' . "\n";

        foreach ($students as $student) {
            $row = [$student->name];
            $totalScore = 0;
            $assignmentCount = 0;

            foreach ($assignments as $assignment) {
                $submission = $student->pengumpulan->first(function($sub) use ($assignment) {
                    return $sub->tugas_id === $assignment->id;
                });

                if ($submission && $submission->nilai !== null) {
                    $row[] = $submission->nilai;
                    $totalScore += $submission->nilai;
                    $assignmentCount++;
                } else {
                    $row[] = 'Belum Dinilai';
                }
            }

            // Calculate average
            $average = $assignmentCount > 0 ? number_format($totalScore / $assignmentCount, 2) : 0;
            $row[] = $average;

            $csvContent .= '"' . implode('","', $row) . '"' . "\n";
        }

        // Set headers for CSV download
        $filename = 'rekap_nilai_' . $kelas->nama_kelas . '_' . date('Y-m-d') . '.csv';
        
        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
