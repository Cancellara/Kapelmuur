<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivatedAccountEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $emailtTo;
    public $subject;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $emailtTo)
    {
        $this->name = $name;
        $this->emailtTo = $emailtTo;
        $this->subject = trans('email/activatedAccount.subject');
        $this->view = 'emails/activedAccount';
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
                ]);
    }

}
