<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LoginForm;
use App\Livewire\RegisterForm;
use Illuminate\Http\Request;
use App\Livewire\Guru\GuruDashboard;
use App\Livewire\Siswa\SiswaDashboard;
use App\Livewire\Guru\ListKelas;
use App\Livewire\Guru\DetailKelas;
use App\Livewire\Siswa\JoinKelas;
use App\Livewire\Siswa\ListKelasYangDiikuti;
use App\Livewire\Siswa\DetailKelasForSiswa;
use App\Livewire\Siswa\SubmitTugas;
use App\Livewire\Guru\ListPengumpulan;
use App\Livewire\Guru\BeriNilai;
use App\Livewire\Guru\CreateDiscussion;
use App\Livewire\ListDiscussions;
use App\Livewire\DiscussionDetail;
use App\Http\Controllers\ExportController;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication routes
Route::get('/login', LoginForm::class)->name('login');
Route::get('/register', RegisterForm::class)->name('register');

// Logout route
Route::post('/logout', function (Request $request) {
    auth()->guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout')->middleware('auth');

// Dashboard routes
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
        Route::get('/users', \App\Livewire\Admin\UserManagement::class)->name('users');
        Route::get('/classes', \App\Livewire\Admin\ClassManagement::class)->name('classes');
        Route::get('/classes/create', \App\Livewire\Admin\CreateClass::class)->name('classes.create');
        Route::get('/classes/{kelas}/edit', \App\Livewire\Admin\EditClass::class)->name('classes.edit');
        Route::get('/classes/{kelas}/subjects', \App\Livewire\Admin\SubjectManagement::class)->name('classes.subjects');
        Route::get('/password-resets', \App\Livewire\Admin\PasswordResetManagement::class)->name('password-resets');
        Route::get('/settings', \App\Livewire\Admin\SystemSettings::class)->name('settings');
        Route::get('/announcements', \App\Livewire\Admin\AnnouncementManagement::class)->name('announcements');
    });

    // Guru routes
    Route::middleware(['guru'])->group(function () {
        Route::get('/guru/dashboard', GuruDashboard::class)->name('guru.dashboard');

        // Guru class management routes
        Route::get('/guru/kelas', ListKelas::class)->name('guru.kelas.index');
        Route::get('/guru/kelas/join', \App\Livewire\Guru\JoinClass::class)->name('guru.kelas.join');
        Route::get('/guru/kelas/{kelas}/select-subjects', \App\Livewire\Guru\SelectSubject::class)->name('guru.select-subjects');
        Route::get('/guru/kelas/{id}', DetailKelas::class)->name('guru.kelas.show');

        // Guru tugas edit route
        Route::get('/guru/kelas/{kelasId}/tugas/{tugasId}/edit', \App\Livewire\Guru\EditTugas::class)->name('guru.tugas.edit');

        // Guru student grades route
        Route::get('/guru/kelas/{kelasId}/siswa/{siswaId}/nilai', \App\Livewire\Guru\StudentGrades::class)->name('guru.siswa.nilai');

        // Guru tugas create route
        Route::get('/guru/kelas/{kelasId}/tugas/create', \App\Livewire\Guru\CreateTugas::class)->name('guru.tugas.create');

        // Guru materi upload route
        Route::get('/guru/kelas/{kelasId}/materi/create', \App\Livewire\Guru\UploadMateri::class)->name('guru.materi.create');
    });

    // Siswa routes
    Route::middleware(['siswa'])->group(function () {
        Route::get('/siswa/dashboard', SiswaDashboard::class)->name('siswa.dashboard');

        // Siswa class joining routes
        Route::get('/siswa/kelas', ListKelasYangDiikuti::class)->name('siswa.kelas.index');
        Route::get('/siswa/kelas/join', JoinKelas::class)->name('siswa.kelas.join');
        Route::get('/siswa/kelas/{id}', DetailKelasForSiswa::class)->name('siswa.kelas.show');
    });
});

// Material download route
Route::get('/materi/download/{id}', function ($id) {
    $materi = Materi::findOrFail($id);

    // Check if user has access to this material (either as teacher of the class or as enrolled student)
    $hasAccess = false;

    if (auth()->user()->isGuru() && $materi->kelas->guru_id == auth()->id()) {
        $hasAccess = true;
    } elseif (auth()->user()->isSiswa() && $materi->kelas->siswa->contains(auth()->id())) {
        $hasAccess = true;
    }

    if (!$hasAccess) {
        abort(403, 'Anda tidak memiliki akses ke materi ini.');
    }

    if (!Storage::disk('public')->exists($materi->file_path)) {
        abort(404, 'File tidak ditemukan.');
    }

    $filename = $materi->judul . '.' . pathinfo($materi->file_path, PATHINFO_EXTENSION);
    $filepath = Storage::disk('public')->path($materi->file_path);
    return response()->download($filepath, $filename);
})->name('materi.download')->middleware('auth');

// Assignment submission route
Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/siswa/tugas/{tugasId}/submit', SubmitTugas::class)->name('siswa.tugas.submit');
});

// Assignment grading routes
Route::middleware(['auth', 'guru'])->group(function () {
    Route::get('/guru/tugas/{tugasId}/pengumpulan', ListPengumpulan::class)->name('guru.tugas.pengumpulan');
    Route::get('/guru/pengumpulan/{pengumpulanId}/nilai', BeriNilai::class)->name('guru.tugas.berinilai');
});

// Discussion routes
Route::middleware(['auth'])->group(function () {
    Route::get('/kelas/{kelasId}/discussions', ListDiscussions::class)->name('discussions.index');
    Route::get('/discussions/{id}', DiscussionDetail::class)->name('discussions.show');

    Route::middleware(['guru'])->group(function () {
        Route::get('/guru/kelas/{kelasId}/discussions/create', CreateDiscussion::class)->name('discussions.create');
    });
});

// Export routes
Route::middleware(['auth', 'guru'])->group(function () {
    Route::get('/guru/kelas/{kelasId}/export', [ExportController::class, 'exportGrades'])->name('guru.kelas.export');
});

// Default route
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isGuru()) {
            return redirect()->route('guru.dashboard');
        } else {
            return redirect()->route('siswa.dashboard');
        }
    }
    return redirect('/login');
});
