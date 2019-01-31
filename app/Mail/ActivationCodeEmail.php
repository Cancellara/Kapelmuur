<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $emailtTo;
    public $subject;
    public $view;
    public $activation_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $emailtTo, string $activation_code, string $view)
    {
        $this->name = $name;
        $this->emailtTo = $emailtTo;
        $this->activation_code = $activation_code;
        $this->subject = trans('email/userRegister.subject');
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->to($this->emailtTo)
            ->view($this->view, ['name' => $this->name,
                    'activation_code' => $this->activation_code]);
    }
}
