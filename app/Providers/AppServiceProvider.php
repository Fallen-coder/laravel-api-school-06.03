<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\CommentPolicy;
use App\Models\Comment;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    protected $polices = [
        Comment::class => CommentPolicy::class,
    ];
}
