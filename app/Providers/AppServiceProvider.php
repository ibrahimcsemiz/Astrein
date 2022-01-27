<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        Component::macro('notify', function ($type, $title, $message) {
            $this->dispatchBrowserEvent('notify', [
                'type' => $type,
                'title' => $title,
                'message' => $message,
            ]);
        });

        RedirectResponse::macro('notify', function ($type, $title, $message) {
            return $this->with('notify', [
                'type' => $type,
                'title' => $title,
                'message' => $message,
            ]);
        });

        Str::macro('setPrice', function ($value) {
            return $value * 100;
        });

        Str::macro('getPrice', function ($value) {
            return $value / 100;
        });

        Str::macro('months', function () {
            for ($i = 1; $i <= 12; $i++) {
                $months[] = str_pad($i, 2, "0", STR_PAD_LEFT);
            }

            return $months;
        });


        /*view()->composer('components.notification', function($view) {
            $view->with('count', User::count());
        });*/

        /*view()->composer('components.notification', function ($view) {
            $messages = self::messages();
            return $view->with('messages', $messages);
        });*/
    }
}
