<?php

namespace App\Livewire\Siswa;

use App\Models\PasswordResetRequest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RequestPasswordReset extends Component
{
    public function requestReset()
    {
        // Check if student already has a pending request
        $existingRequest = PasswordResetRequest::where('student_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            session()->flash('error', 'You already have a pending password reset request.');
            return;
        }

        // Create new password reset request
        PasswordResetRequest::create([
            'student_id' => Auth::id(),
            'status' => 'pending',
            'token' => null, // Will be set when admin approves
        ]);

        session()->flash('message', 'Password reset request submitted successfully. Please wait for admin approval.');
    }

    public function render()
    {
        // Check current request status
        $currentRequest = PasswordResetRequest::where('student_id', Auth::id())
            ->latest()
            ->first();

        return view('livewire.siswa.request-password-reset', [
            'currentRequest' => $currentRequest
        ])->layout('layouts.app');
    }
}
