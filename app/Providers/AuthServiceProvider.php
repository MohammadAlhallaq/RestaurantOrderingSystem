<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Complete your registration')
                ->line('Welcome to Allin1UAE family, the only platform that removes all hurdles in the process of buying and selling of goods and services by providing a wider and secured market for legitimate businesses in the UAE.
To start Selling on Allin1UAE, please complete your registration by providing required information through the link below.
')
                ->action('Complete Your Registration', $url)
                ->line('Please provide your active Bank Account information, you will receive payment and disbursements from Allin1UAE in this account.
For further Information or Assistance, please email us on support@allin1uae.com or call 06 550 0077.
');
        });
        //
    }
}
