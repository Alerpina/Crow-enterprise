<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Database\Seeds\AdminLanguagesTableSeeder::class);
        $this->call(Database\Seeds\AdminsTableSeeder::class);
        $this->call(Database\Seeds\CountriesTableSeeder::class);
        $this->call(Database\Seeds\StatesTableSeeder::class);
        $this->call(Database\Seeds\CitiesTableSeeder::class);
        $this->call(Database\Seeds\CountersTableSeeder::class);
        $this->call(Database\Seeds\CurrenciesTableSeeder::class);
        $this->call(Database\Seeds\EmailTemplatesTableSeeder::class);
        $this->call(Database\Seeds\EmailTemplateTranslationsTableSeeder::class);
        $this->call(Database\Seeds\GeneralsettingsTableSeeder::class);
        $this->call(Database\Seeds\GeneralsettingTranslationsTableSeeder::class);
        $this->call(Database\Seeds\LanguagesTableSeeder::class);
        $this->call(Database\Seeds\NotificationsTableSeeder::class);
        $this->call(Database\Seeds\PagesettingsTableSeeder::class);
        $this->call(Database\Seeds\PagesettingTranslationsTableSeeder::class);
        $this->call(Database\Seeds\PaymentGatewaysTableSeeder::class);
        $this->call(Database\Seeds\RolesTableSeeder::class);
        $this->call(Database\Seeds\RoleTranslationsTableSeeder::class);
        $this->call(Database\Seeds\SeotoolsTableSeeder::class);
        $this->call(Database\Seeds\SeotoolTranslationsTableSeeder::class);
        $this->call(Database\Seeds\ServicesTableSeeder::class);
        $this->call(Database\Seeds\ServiceTranslationsTableSeeder::class);
        $this->call(Database\Seeds\SocialProvidersTableSeeder::class);
        $this->call(Database\Seeds\SocialsettingsTableSeeder::class);
        $this->call(Database\Seeds\SubscriptionsTableSeeder::class);
        $this->call(Database\Seeds\SubscriptionTranslationsTableSeeder::class);
        $this->call(Database\Seeds\PackagesTableSeeder::class);
        $this->call(Database\Seeds\PackageTranslationsTableSeeder::class);

        # Clear cache after run all Seeders. It prevents application to start with empty Generalsetting model.
        Artisan::call('cache:clear');
    }
}
