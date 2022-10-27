<?php

namespace App\Services;

use App\Http\Controllers\Admin\XmlController;
use Illuminate\Console\Command;

class XmlService
{
    public function importProductsByXml(Command $command, $file_name)
    {
       $controller = new XmlController;
       $controller->importProductXml($command, $file_name);
    }
}
