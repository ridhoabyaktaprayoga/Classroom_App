<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAssignmentNotification extends Notification
{
    use Queueable;

    public $tugas;

    /**
     * Create a new notification instance.
     */
    public function __construct($tugas)
    {
        $this->tugas = $tugas;
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
            'title' => 'Tugas Baru Ditambahkan',
            'message' => 'Tugas baru "' . $this->tugas->judul . '" telah ditambahkan ke kelas ' . $this->tugas->kelas->nama_kelas,
            'tugas_id' => $this->tugas->id,
            'kelas_id' => $this->tugas->kelas->id,
            'type' => 'assignment',
            'data' => [
                'tugas_judul' => $this->tugas->judul,
                'kelas_nama' => $this->tugas->kelas->nama_kelas,
            ]
        ];
    }
}
