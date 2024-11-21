<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDeviceLoggedInNotification extends Notification
{
    use Queueable;

    public $ip;
    public $device;
    public $platform;
    public $date;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ip, $device, $platform, $date)
    {
        $this->ip = $ip;
        $this->device = $device;
        $this->platform = $platform;
        $this->date = $date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->view('emails.new-device-logged', [
                        'ip' => $this->ip,
                        'device' => $this->device,
                        'platform' => $this->platform,
                        'date' => $this->date,
                        'name' => auth()->user()->name,
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
