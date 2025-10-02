<?php

namespace App\Policies;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KelasPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Users can view their own classes
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Kelas $kelas): bool
    {
        // Allow if user is the teacher of the class or a student enrolled in the class
        return $kelas->guru_id === $user->id || $kelas->siswa->contains($user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isGuru(); // Only teachers can create classes
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Kelas $kelas): bool
    {
        // Only the teacher who created the class can update it
        return $kelas->guru_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Kelas $kelas): bool
    {
        // Only the teacher who created the class can delete it
        return $kelas->guru_id === $user->id && is_null($kelas->deleted_at);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Kelas $kelas): bool
    {
        // Only the teacher who created the class can restore it
        return $kelas->guru_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Kelas $kelas): bool
    {
        return false; // Prevent permanent deletion
    }
}
