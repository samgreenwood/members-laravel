<?php

namespace App\Providers;

use Braintree_Configuration;
use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        Braintree_Configuration::environment(config('braintree.environment'));
        Braintree_Configuration::merchantId(config('braintree.merchant_id'));
        Braintree_Configuration::publicKey(config('braintree.public_key'));
        Braintree_Configuration::privateKey(config('braintree.private_key'));
    }
}
