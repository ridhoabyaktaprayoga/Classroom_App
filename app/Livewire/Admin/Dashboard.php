<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalUsers = User::count();
        $totalTeachers = User::where('role', 'guru')->count();
        $totalStudents = User::where('role', 'siswa')->count();
        $totalClasses = Kelas::count();

        $recentUsers = User::latest()->take(5)->get();
        $recentClasses = Kelas::latest()->take(5)->get();

        $userRegistrationData = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('livewire.admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalTeachers' => $totalTeachers,
            'totalStudents' => $totalStudents,
            'totalClasses' => $totalClasses,
            'recentUsers' => $recentUsers,
            'recentClasses' => $recentClasses,
            'userRegistrationData' => $userRegistrationData,
        ])->layout('layouts.admin');
    }
}
