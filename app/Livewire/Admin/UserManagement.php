<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $layout = 'layouts.admin';

    public $selectedUser;
    public $newRole;

    public function render()
    {
        return view('livewire.admin.user-management', [
            'users' => User::paginate(10)
        ]);
    }

    public function changeRole(User $user, $newRole)
    {
        $user->role = $newRole;
        $user->save();

        session()->flash('message', 'User role updated successfully.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        session()->flash('message', 'User deleted successfully.');
    }
}
