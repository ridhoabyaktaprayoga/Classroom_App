<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    public function render()
    {
        // Check if notifications table exists to avoid errors during installation
        try {
            $unreadNotifications = auth()->user()->notifications()->whereNull('read_at')->get();
            $allNotifications = auth()->user()->notifications()->latest()->limit(10)->get();
            
            return view('livewire.notification-bell', [
                'unreadNotifications' => $unreadNotifications,
                'allNotifications' => $allNotifications,
                'unreadCount' => $unreadNotifications->count(),
            ]);
        } catch (\Exception $e) {
            // If notifications table doesn't exist yet, return empty data
            return view('livewire.notification-bell', [
                'unreadNotifications' => collect(),
                'allNotifications' => collect(),
                'unreadCount' => 0,
            ]);
        }
    }
    
    public function markAsRead($notificationId)
    {
        try {
            $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
            if ($notification) {
                $notification->markAsRead();
            }
            
            $this->dispatch('notification-read');
        } catch (\Exception $e) {
            // Handle gracefully if notifications table doesn't exist
        }
    }
    
    public function markAllAsRead()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
            
            $this->dispatch('notification-read');
        } catch (\Exception $e) {
            // Handle gracefully if notifications table doesn't exist
        }
    }
}
