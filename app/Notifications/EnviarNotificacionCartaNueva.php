<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class EnviarNotificacionCartaNueva extends Notification
{
    use Queueable;
    protected $carta;
    /**
     * Create a new notification instance.
     */
    public function __construct($carta)
    {
        $this->carta=$carta;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $ninio=$this->carta->ninio;
        $data = array();

        if($ninio->email){
            array_push($data,'email');
        }
        if($ninio->fcm_token){
            array_push($data,'firebase');
        }
        return $data;
        
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $ninio=$this->carta->ninio;
        $es=$ninio->genero==='Female'?'Estimada Niña':'Estimado Niño';
        $url=route('cartas-ninio.ver',['idcarta'=>Crypt::encryptString($this->carta->id),'numero_child'=>Crypt::encryptString($ninio->numero_child)]);
        return (new MailMessage)
                    ->subject('Tiene nueva carta de '.$this->carta->tipo)
                    ->line('CACTU piensa en ti y te ayuda a recibir tus carta de tu patrocinador!')
                    ->line($es.' tiene una nueva carta, porfavor ingresa al siguente enlace para responder.')
                    ->action('Responder carta de '.$this->carta->tipo, $url)
                    ->line('Gracias por tu atención!');
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
    public function toFirebase($notifiable)
    {
        $ninio=$this->carta->ninio;
        $deviceTokens =$ninio->fcm_token;
        
        return   (new FirebaseMessage)
            ->withTitle('Nueva carta')
            ->withBody('Tiene una nueva carta de '.$this->carta->tipo.' por responder.')
            ->asNotification($deviceTokens);
    }
}
