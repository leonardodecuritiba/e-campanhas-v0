<?php

namespace App\Providers;

use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use App\Observers\HumanResources\Settings\GroupObserver;
use App\Observers\HumanResources\UserObserver;
use App\Observers\HumanResources\VoterObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//	    $this->app->singleton( FakerGenerator::class, function () {
//		    return FakerFactory::create( 'pt_BR' );
//	    } );

        Schema::defaultStringLength( 191 );
        User::observe( UserObserver::class );
        Voter::observe( VoterObserver::class );
        Group::observe( GroupObserver::class );

    }
}
