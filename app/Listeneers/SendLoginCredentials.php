<?php

namespace App\Listeneers;

use App\Events\UserWasCreated;
use App\Mail\LoginCredentials;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoginCredentials
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

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        //*Enviar al correo la contraseña
        Mail::to($event->user)->queue(
            new LoginCredentials($event->user, $event->password)
        );
    }
}