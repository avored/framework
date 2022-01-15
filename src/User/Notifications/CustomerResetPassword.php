<?php

namespace AvoRed\Framework\User\Notifications;

use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Repository\ConfigurationRepository;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $repositroy = $this->getConfigurationRepository();
        $resetLink = $repositroy->getValueByCode('customer_reset_password_link');
        $url = $resetLink . "?token=" . $this->token;
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url)
            ->line('If you did not request a password reset, no further action is required.');
    }


    /**
     * Get the instance of an Configuration repository
     * @return ConfigurationRepository
     */
    public function getConfigurationRepository() : ConfigurationRepository
    {
        return app(ConfigurationModelInterface::class);
    }
}
