<?php

namespace App\Providers;

use App\Http\Middleware\EnsureUserHasRole;
use App\Models\Order;
use App\Models\Post;
use App\Policies\OrderPolicy;
use App\Policies\PostPolicy;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        Route::aliasMiddleware('role', EnsureUserHasRole::class);

        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);

        Blade::directive('rupiah', function (string $expression) {
            return "<?php echo 'Rp ' . number_format((int) ({$expression}), 0, ',', '.'); ?>";
        });
    }
}
