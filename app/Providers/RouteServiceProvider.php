<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin/dashboard';

    //protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */

    //  public function map(): void
    //  {
    //      $this->mapApiv1Routes();
    //      $this->mapApiv2Routes();
 
    //      $this->mapWebRoutes();
     
         
    //  }
    public function boot(): void
    {
        //parent::boot();
        // RateLimiter::for('api', function (Request $request) {
        //     return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        // });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1') 
                ->group(base_path('routes/api/v1/api.php'));
 
            // For future v2 integration:
            Route::middleware('api')
                ->prefix('api/v2')
                ->group(base_path('routes/api/v1/api.php'));
 
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });



       
    }

    protected function mapApiv1Routes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v1/api.php'));
    }

    protected function mapApiv2Routes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v2/api.php'));
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
