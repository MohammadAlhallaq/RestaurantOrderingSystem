<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $account;
    public $language_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($account, $language_id)
    {
        $this->account = $account;
        $this->language_id = $language_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->language_id == 2 ? 'إتمام عملية التسجيل' : 'Complete your registration')
            ->markdown($this->language_id == 2 ? 'mails.verifyUser_ar':'mails.verifyUser');
    }
}
