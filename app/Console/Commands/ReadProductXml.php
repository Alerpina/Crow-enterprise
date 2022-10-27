<?php

namespace App\Console\Commands;

use App\Services\XmlService;
use Illuminate\Console\Command;

class ReadProductXml extends Command
{
    public $controller;
    public $output;

    public function __construct()
    {
        $this->controller = new XmlService;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read XML file and import products';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->controller->importProductsByXml($this);

        return 0;
    }
}
