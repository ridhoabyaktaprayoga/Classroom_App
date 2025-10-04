<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
        'remember' => 'boolean',
    ];

    public function render()
    {
        return view('livewire.login-form');
    }

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $credentials['remember'])) {
            $user = Auth::user();

            // Redirect based on user role
            if ($user->isAdmin()) {
                return $this->redirectRoute('admin.dashboard', navigate: true);
            } elseif ($user->isGuru()) {
                return $this->redirectRoute('guru.dashboard', navigate: true);
            } else {
                return $this->redirectRoute('siswa.dashboard', navigate: true);
            }
        }

        $this->addError('email', 'Kredensial yang diberikan tidak cocok dengan catatan kami.');
    }
}
