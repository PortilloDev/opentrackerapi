<?php

namespace App\Providers;

use App\Events\AuditEvent;
use App\Events\UserRegisteredAsLead;
use App\Listeners\AuditEventListener;
use App\Listeners\RegisterUserAsLead;
use App\Listeners\SendEmailVerificationNotification;
use App\Service\LeadsService\LeadsRegisterService;
use App\Service\LeadsService\LeadsRegisterServiceInterface;
use App\Service\NeswletterService\NewsletterService;
use App\Service\NeswletterService\NewsletterServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NewsletterServiceInterface::class, NewsletterService::class);
        $this->app->bind(LeadsRegisterServiceInterface::class, LeadsRegisterService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            UserRegisteredAsLead::class,
            RegisterUserAsLead::class
        );
        Event::listen(
            Registered::class,
            SendEmailVerificationNotification::class
        );
        Event::listen(
            AuditEvent::class,
            AuditEventListener::class
        );
    }
}
