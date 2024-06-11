<?php
namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserLoginLog; // Asegúrate de importar el modelo necesario
use App\Models\Log;

class LogUserLogin
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
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        dd($event->user); // Comprueba si el evento está pasando los datos correctamente

        Log::create([
            'user_id' => $event->user->id,
            'action' => 'Login',
        ]);
    }
}