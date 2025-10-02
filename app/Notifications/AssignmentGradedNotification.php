<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pengumpulan;

class AssignmentGradedNotification extends Notification
{
    use Queueable;

    public $pengumpulan;

    /**
     * Create a new notification instance.
     */
    public function __construct($pengumpulan)
    {
        $this->pengumpulan = $pengumpulan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Tugas Telah Dinilai',
            'message' => 'Tugas "' . $this->pengumpulan->tugas->judul . '" telah dinilai. Nilai: ' . $this->pengumpulan->nilai,
            'tugas_id' => $this->pengumpulan->tugas->id,
            'pengumpulan_id' => $this->pengumpulan->id,
            'type' => 'grade',
            'data' => [
                'tugas_judul' => $this->pengumpulan->tugas->judul,
                'nilai' => $this->pengumpulan->nilai,
                'komentar' => $this->pengumpulan->komentar,
            ]
        ];
    }
}
