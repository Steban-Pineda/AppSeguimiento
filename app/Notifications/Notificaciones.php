<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notificaciones extends Notification
{
    use Queueable;

    public $documento; // <--- 1. Variable para guardar los datos

    public function __construct($documento)
    {
        $this->documento = $documento;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        // 3. Personaliza el contenido del correo
        return (new MailMessage)
            ->subject('Nuevo Documento: ' . $this->documento->Denominacion)
            ->greeting('Hola, Steban Pineda')
            ->line('Se ha registrado un nuevo aprendiz en el sistema.')
            ->line('Numero documento: ' . $this->documento->Numdoc)
            ->line('Nombres: ' . $this->documento->Nombres)
            ->line('Apellidos: ' . $this->documento->Apellidos)
            ->line('Ficha de caracterización: ' . ($this->documento->ficha->Denominacion ?? 'No asignada'))
            ->action('Ver en el Sistema', url('/Aprendices'))
            ->line('Este es un correo automático de Soporte.');
    }
}
