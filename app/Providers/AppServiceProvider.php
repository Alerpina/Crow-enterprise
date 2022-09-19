<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\Language;
use App\Models\Generalsetting;
use App\Models\Order;
use App\Observers\OrderObserver;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->runningInConsole()) {
            Paginator::useBootstrap();

            $currentUrl = str_replace(
                ['http://', 'https://'],
                '',
                url()->current()
            );
            # Disable Cache for Multistore
            $storeSettings = Generalsetting::whereRaw("'{$currentUrl}' LIKE CONCAT(domain,'%')")->first();

            if (!$storeSettings || empty($storeSettings->domain)) {
                $storeSettings = $this->getStoreSettings();
            }

            # Get populated StoreSettings cache after migrations run (application ready) if current $storeSettings has no ID (empty)
            # This is useful if cache:clear is not run after db:seed
            if (!$storeSettings->id && Schema::hasTable('generalsettings') && Generalsetting::count() > 0) {
                return $this->forgetGeneralSettingsCache();
            }

            # When saving or updating Generalsetting, just forget Cache and instantiate a new object.
            Generalsetting::saving(function () {
                return $this->forgetGeneralSettingsCache();
            });

            Generalsetting::updated(function () {
                return $this->forgetGeneralSettingsCache();
            });

            # UTC if is Global shipping
            if (!$storeSettings->country_ship) {
                Config::set('app.timezone', 'UTC');
                date_default_timezone_set('UTC');
            }

            # America/Sao_Paulo if is Global shipping
            if ($storeSettings->country_ship === "BR") {
                Config::set('app.timezone', 'America/Sao_Paulo');
                date_default_timezone_set('America/Sao_Paulo');
            }

            # America/Asuncion if is Global shipping
            if ($storeSettings->country_ship === "PY") {
                Config::set('app.timezone', 'America/Asuncion');
                date_default_timezone_set('America/Asuncion');
            }

            Order::observe(OrderObserver::class);

            if (!app()->runningInConsole()) {
                if (env('APP_ENV') == 'production') {
                    URL::forceScheme('https');
                }

                $locales = Language::all();
                $storeLocale = $locales->find($storeSettings->lang_id);
                $currencies = Currency::all();
                $storeCurrency = $currencies->find($storeSettings->currency_id);
                $transLocales = App::make('translatable.locales');

                foreach ($locales as $locale) {
                    $transLocales->add($locale->locale);
                }
                $transLocales->forget('en999');

                $lang = Language::find(1);
                Config::set('translatable.fallback_locale', $lang->locale);
                app()->instance('storeLocale', $storeLocale);
                app()->instance('locales', $locales);
                app()->instance('storeCurrency', $storeCurrency);
                app()->instance('currencies', $currencies);
                app()->instance('lang', $lang);
            }
            app()->instance('storeSettings', $storeSettings);
        }

        if (app()->runningInConsole()) {
            $storeSettings = new Generalsetting;
            app()->instance('storeSettings', $storeSettings);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
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
    }

    protected function getStoreSettings()
    {
        # Remember Generalsetting Cache for one hour. It will be invalidated if Generalsetting is updated or saved in any way.
        return Cache::remember("storeSettings", 60 * 60, function () {
            # Return empty object if there's no migration yet
            if (!Schema::hasTable('generalsettings')) {
                return new Generalsetting;
            }
            return Generalsetting::where('is_default', 1)->first();
        });
    }

    protected function forgetGeneralSettingsCache()
    {
        if (Cache::has("storeSettings")) {
            Cache::forget("storeSettings");
        }
        $storeSettings = $this->getStoreSettings();
        return $storeSettings;
    }
}
