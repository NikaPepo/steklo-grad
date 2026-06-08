<?php

namespace App\Providers;

use App\Enums\OptionEnum;
use App\Models\Category;
use App\Models\Option;
use App\Models\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        Carbon::setLocale('ru');
        View::composer([
            'guest.*',
            'layouts.partials.*'
        ], function ($view) {
            $parents = Category::whereNull('parent_id')
                ->orderBy('name', 'desc')
                ->get();

            $services = Service::orderBy('name', 'asc')->get();

            $options = Option::whereIn('name', [
                OptionEnum::Post->value,
                OptionEnum::Phone->value,
                OptionEnum::Phone2->value])
                ->pluck('value', 'name');
            $view->with([
                'post' => $options[OptionEnum::Post->value] ?? null,
                'phone' => $options[OptionEnum::Phone->value] ?? null,
                'phone2' => $options[OptionEnum::Phone2->value] ?? null,
                'menuParents' => $parents,
                'menuServices' => $services,
                'currentCategory' => request()->route('category') ?? null,
            ]);
        });

    }
}
