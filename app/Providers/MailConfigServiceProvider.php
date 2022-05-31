<?php

namespace App\Providers;

use App\Models\Generalsetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('generalsettings')){
            $storeSettings = Generalsetting::where('is_default', 1)->first();

            if($storeSettings){
                $mail_driver = "sendmail";

                if ($storeSettings->header_email == 'smtp') {
                    $mail_driver = 'smtp';
                }

                $config = [
                    "driver" => $mail_driver,
                    "host" => $storeSettings->smtp_host,
                    "port" => $storeSettings->smtp_port,
                    "from" => [
                        "address" => $storeSettings->from_email,
                        "name" => $storeSettings->from_name
                    ],
                    "encryption" => $storeSettings->email_encryption,
                    "username" => $storeSettings->smtp_user,
                    "password" => $storeSettings->smtp_pass,
                ];

                Config::set('mail', array_merge(Config::get('mail'), $config));
            }
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}
