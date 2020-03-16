<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $object;
    public $partialView;

    /**
     * ResetPassword constructor.
     * @param $object
     * @param $view
     * @param $subject
     * @param $from
     */
    public function __construct($object , $view , $subject , $from)
    {
        $this->object = $object;
        $this->partialView = $view;
        $this->subject = $subject;
        $this->from = $from;

    }

    /**
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.mailPublic',['object' => $this->object , 'blade' => $this->partialView]);
    }
}
