<?php

namespace App\Listeners;

use App\Events\UserRegisteredAsLead;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendEmailVerificationNotification implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * The number of times the queued listener may be attempted.
     *
     */
    public int $tries = 5;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $event->user->sendEmailVerificationNotification();
    }

    public function failed(Registered $event, \Throwable $exception): void
    {
        Log::critical('El listener RegisterUserAsLead falló después de todos los intentos.', [
            'user_email' => $event->user->email,
            'exception_message' => $exception->getMessage(),
            'exception_trace' => $exception->getTraceAsString(),
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to('contacto@notasweb.me')->send(
                new \App\Mail\FailedJobNotification(
                    'RegisterUserAsLead',
                    $event->user->email,
                    $exception->getMessage()
                )
            );
        } catch (\Exception $e) {
            Log::error('Error al enviar notificación de fallo del listener: ' . $e->getMessage());
        }
    }

    public function retryUntil(): \DateTime
    {
        return now()->addMinutes(5);
    }
}
