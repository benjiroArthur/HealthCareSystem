<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
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

        /*if($this->data['who'] === 'doctor'){
            $name = 'Dr. '.ucfirst($this->data['first_name']).' '.ucfirst($this->data['other_name']).' '.ucfirst($this->data['last_name']);
        }
        else if($this->data['who'] === 'admin'){
            $name = 'Mr/Miss. '.ucfirst($this->data['first_name']).' '.ucfirst($this->data['other_name']).' '.ucfirst($this->data['last_name']);
        }
        else{
            $name = $this->data['pharmacy_name'];
        }*/
        return (new MailMessage)
                    ->subject(Lang::get('Your Account Password'))
                    ->greeting('Hello! '.$this->data['name'])
                    ->line(Lang::get('Welcome to E-Health Care Center.'))
                    ->line(Lang::get('This is your password to your account.'))
                    ->line(Lang::get('Password:  <strong>'.$this->data['password'].'</strong>'))
                    ->line(Lang::get('Please don\'t forget to change your password after login.'))
                    ->line(Lang::get('Thank You For Joining E-Health Care Center.'));
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
