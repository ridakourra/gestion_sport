<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMatchScheduled extends Notification
{
    use Queueable;


    protected $matche;

    /**
     * Create a new notification instance.
     */
    public function __construct($matche)
    {
        $this->matche = $matche;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Un nouveau match a été programmé!')
            ->line('Détails du match:')
            ->line('Sport: ' . $this->matche->sport->nom)
            ->line('Équipe 1: ' . $this->matche->equipe1->nom)  // Changed from equipe to equipe1
            ->line('Équipe 2: ' . $this->matche->equipe2->nom)  // Changed from equipe to equipe2
            ->line('Date: ' . $this->matche->date_matche->format('d/m/Y H:i'))  // Added proper date formatting
            ->line('Lieu: ' . $this->matche->lieu)  // Added venue information
            ->action('Voir le match', url('/matches/' . $this->matche->id))
            ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
