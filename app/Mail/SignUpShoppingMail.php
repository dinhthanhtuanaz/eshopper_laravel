<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignUpShoppingMail extends Mailable
{
    use Queueable, SerializesModels;
    private $title;
    private $dataArr;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $dataArr)
    {
        $this->title = $title;
        $this->dataArr = $dataArr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('form_emails.password_receipt')
                    ->subject($this->title)
                    ->with($this->dataArr);
    }
}
