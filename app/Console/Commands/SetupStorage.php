<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class SetupStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create specific user content folders inside storage/app/public';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $folders = [
            'images',
            'images/products',
            'images/thumbnails',
            'images/galleries',
            'xml',
        ];

        foreach ($folders as $folder) {
            try {
                if (!is_dir(public_path().'/storage/'.$folder)) {
                    $this->info("creating folder {$folder}");
                    mkdir(public_path().'/storage/'.$folder);
                }
            } catch (Exception $e) {
                $this->error("it was not possible to create folder {$folder}");
                $this->line($e->getMessage());
                return 1;
            }
        }

        $this->info('storage folders ready. Make sure to adjust permissions afterwards, if necessary');
        return 0;
    }
}
