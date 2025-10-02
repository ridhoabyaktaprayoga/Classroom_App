<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:guru,siswa',
    ];

    public function render()
    {
        return view('livewire.register-form');
    }

    public function register()
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->isGuru()) {
            return $this->redirectRoute('guru.dashboard', navigate: true);
        } else {
            return $this->redirectRoute('siswa.dashboard', navigate: true);
        }
    }
}
