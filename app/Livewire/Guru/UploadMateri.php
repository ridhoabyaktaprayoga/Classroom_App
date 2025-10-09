<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Materi;
use App\Models\Kelas;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class UploadMateri extends Component
{
    use WithFileUploads;

    public $kelas_id;
    public $subject_id;
    public $judul;
    public $deskripsi;
    public $file;

    protected function rules()
    {
        return [
            'kelas_id' => 'required|exists:kelas,id',
            'subject_id' => 'required|exists:subjects,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,ppt,pptx,doc,docx|max:10240', // 10MB max
        ];
    }

    public function updatedKelasId()
    {
        $this->subject_id = null; // Reset subject when class changes
    }

    public function render()
    {
        // Get classes where teacher has joined and selected subjects
        $kelasList = Kelas::whereHas('teachers', function($query) {
            $query->where('teacher_id', Auth::id());
        })->get();

        $subjects = collect();
        if ($this->kelas_id) {
            // Get subjects teacher has selected for this class
            $subjects = Subject::where('class_id', $this->kelas_id)
                ->whereHas('kelas.teachers', function($query) {
                    $query->where('teacher_id', Auth::id())
                          ->where('subject_id', \DB::raw('subjects.id'));
                })->get();
        }

        return view('livewire.guru.upload-materi', [
            'kelasList' => $kelasList,
            'subjects' => $subjects
        ]);
    }

    public function uploadMateri()
    {
        $validated = $this->validate();

        // Store the file
        $filePath = $this->file->store('materi', 'public');

        // Create the materi
        Materi::create([
            'kelas_id' => $validated['kelas_id'],
            'subject_id' => $validated['subject_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'file_path' => $filePath,
        ]);

        session()->flash('message', 'Materi berhasil diunggah.');

        // Reset form
        $this->reset(['kelas_id', 'judul', 'deskripsi', 'file']);

        // Redirect to kelas detail
        return $this->redirectRoute('guru.kelas.show', ['id' => $validated['kelas_id']], navigate: true);
    }
}
