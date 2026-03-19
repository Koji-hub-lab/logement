<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationStatusChanged extends Notification
{
    use Queueable;

    protected $reservation;
    protected $statut;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->statut = $reservation->statut;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Mise à jour de votre demande de réservation')
            ->greeting('Bonjour ' . $notifiable->prenom . ',');

        if ($this->statut === 'acceptée') {
            $message->line('Bonne nouvelle ! Votre demande de réservation pour "' . $this->reservation->logement->titre . '" a été acceptée.')
                    ->line('Prix : ' . number_format($this->reservation->logement->prix, 0, ',', ' ') . ' FCFA/mois')
                    ->action('Voir mes réservations', url('/client/reservations'))
                    ->line('Le propriétaire va vous contacter prochainement.');
        } else {
            $message->line('Votre demande de réservation pour "' . $this->reservation->logement->titre . '" a été refusée.')
                    ->action('Voir d\'autres logements', url('/'))
                    ->line('N\'hésitez pas à consulter d\'autres logements disponibles.');
        }

        return $message->line('Merci d\'utiliser AppartMe !');
    }
}