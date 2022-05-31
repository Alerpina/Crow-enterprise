<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Helper;

class ForceUpdateLangs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:langs {override_all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Force Update Languages';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $override_all = $this->argument('override_all') == "true" ? true : false;
        Helper::updateAllLanguages($override_all);
        Helper::updateAllAdminLanguages($override_all);
    }
}
