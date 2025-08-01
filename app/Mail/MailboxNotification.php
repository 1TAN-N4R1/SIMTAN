<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MailboxMessage;

class MailboxNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;

    public function __construct(MailboxMessage $message)
    {
        $this->messageData = $message;
    }

    public function build()
    {
        return $this->subject($this->messageData->title)
            ->html($this->messageData->body); // langsung gunakan body yang sudah dirender Blade
    }
}
