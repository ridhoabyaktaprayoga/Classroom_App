<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class SystemSettings extends Component
{
    public $layout = 'layouts.admin';

    public $appName;
    public $allowPublicRegistration;

    public function mount()
    {
        $this->appName = Setting::where('key', 'app_name')->first()->value ?? config('app.name');
        $this->allowPublicRegistration = Setting::where('key', 'allow_public_registration')->first()->value ?? true;
    }

    public function render()
    {
        return view('livewire.admin.system-settings');
    }

    public function save()
    {
        $this->validate([
            'appName' => 'required|string|max:255',
            'allowPublicRegistration' => 'required|boolean',
        ]);

        Setting::updateOrCreate(['key' => 'app_name'], ['value' => $this->appName]);
        Setting::updateOrCreate(['key' => 'allow_public_registration'], ['value' => $this->allowPublicRegistration]);

        session()->flash('message', 'Settings saved successfully.');
    }
}
