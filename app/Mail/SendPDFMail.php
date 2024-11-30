<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPDFMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $filePath;
    public $fileUrl;

    public function __construct($user, $filePath, $fileUrl)
    {
        $this->user = $user;
        $this->filePath = $filePath;
        $this->fileUrl = $fileUrl;
    }

    public function build()
    {
        $email = $this->markdown('email.send_document')->subject(config('app.name') . ', Send Document');

        if (!empty($this->fileUrl)) {
            $email->attach($this->fileUrl);
        }
        return $email;
    }
}
