<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class FirebaseNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $deviceToken;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title,$message,$deviceToken)
    {
        $this->title = $title;
        $this->message = $message;
        $this->deviceToken = $deviceToken;
    }

    public function sendNotification()
    {
        $SERVER_API_KEY = 'AAAAj8qswuw:APA91bG6YkLRnIRGu__k8SM1K0k9b8Y3Qk0iAjzjS4Y4q_Hn72MSbAPmAtEJ1QQoobOP7Lamb1awYrtWBrxCMn8I_xqHEECNaxszqIo1cP2Ss7bO0hH2N8N8W6LjWDZwopujaTvNIlIy';
        $data = [
            "registration_ids" => $this->deviceToken,
            "notification" => [
                "title" => $this->title,
                "body" => $this->message,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $headers = [
            'Authorization' => 'key='.$SERVER_API_KEY,
            'Content-Type' => 'application/json',
        ];
        $result = Http::withHeaders($headers)->post('https://fcm.googleapis.com/fcm/send', $data);
        return $result;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
//    public function via($notifiable)
//    {
//        return ['mail'];
//    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function sendNotification($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
//    public function toArray($notifiable)
//    {
//        return [
//            //
//        ];
//    }
}
