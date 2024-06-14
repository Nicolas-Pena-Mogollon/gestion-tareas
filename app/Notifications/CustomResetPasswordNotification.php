<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends Notification
{
    public $token;

    /**
     * Crea una nueva instancia de la notificación.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Obtiene los canales de entrega de la notificación.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtiene la representación del correo electrónico de la notificación.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));

        return (new MailMessage)
                    ->subject('Restablecimiento de Contraseña')
                    ->line('Estás recibiendo este correo porque hiciste una solicitud de restablecimiento de contraseña para tu cuenta.')
                    ->action('Restablecer Contraseña', $url)
                    ->line('Si no realizaste esta solicitud, no se requiere ninguna acción adicional.');
    }
}
