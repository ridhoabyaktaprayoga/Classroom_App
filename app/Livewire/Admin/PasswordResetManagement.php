<?php

namespace App\Livewire\Admin;

use App\Models\PasswordResetRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\PasswordResetApprovedNotification;

class PasswordResetManagement extends Component
{
    use WithPagination;

    public function approveRequest(PasswordResetRequest $request)
    {
        // Generate new password
        $newPassword = Str::random(8);

        // Update user password
        $request->student->update([
            'password' => Hash::make($newPassword),
        ]);

        // Update request status
        $request->update([
            'status' => 'approved',
            'token' => $newPassword, // Store the new password temporarily
        ]);

        // Notify student
        $request->student->notify(new PasswordResetApprovedNotification($newPassword));

        session()->flash('message', 'Password reset approved. Student has been notified.');
    }

    public function rejectRequest(PasswordResetRequest $request)
    {
        $request->update(['status' => 'rejected']);

        session()->flash('message', 'Password reset request rejected.');
    }

    public function render()
    {
        $requests = PasswordResetRequest::with('student')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.password-reset-management', [
            'requests' => $requests
        ])->layout('layouts.admin');
    }
}
