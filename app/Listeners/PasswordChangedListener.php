<?php

namespace App\Listeners;

use App\Events\PasswordChanged;
use App\Mail\PasswordChanged as MailPasswordChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PasswordChangedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }



        public function handle(PasswordChanged $event)
        {
            // Send the email notification
            Mail::to($event->user->email)->send(new MailPasswordChanged());
        }
    }
