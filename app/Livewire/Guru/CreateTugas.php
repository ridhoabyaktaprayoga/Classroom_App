<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Subject;
use App\Notifications\NewAssignmentNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateTugas extends Component
{
    public $kelas_id;
    public $subject_id;
    public $judul;
    public $deskripsi;
    public $deadline;

    protected function rules()
    {
        return [
            'kelas_id' => 'required|exists:kelas,id',
            'subject_id' => 'required|exists:subjects,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date|after:now',
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

        return view('livewire.guru.create-tugas', [
            'kelasList' => $kelasList,
            'subjects' => $subjects
        ]);
    }

    public function createTugas()
    {
        $validated = $this->validate();

        $tugas = Tugas::create([
            'kelas_id' => $validated['kelas_id'],
            'subject_id' => $validated['subject_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'deadline' => $validated['deadline'],
        ]);

        // Send notification to all students in the class
        $kelas = Kelas::find($validated['kelas_id']);
        $students = $kelas->siswa;

        foreach ($students as $student) {
            $student->notify(new NewAssignmentNotification($tugas));
        }

        session()->flash('message', 'Tugas berhasil dibuat.');

        // Reset form
        $this->reset(['kelas_id', 'judul', 'deskripsi', 'deadline']);

        // Redirect to kelas detail
        return $this->redirectRoute('guru.kelas.show', ['id' => $validated['kelas_id']], navigate: true);
    }
}
