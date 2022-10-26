<?php

namespace App\Services;

use App\Http\Controllers\Admin\XmlController;
use Illuminate\Console\Command;

class XmlProduct
{
    public function importProductsByXml(Command $command)
    {
       $controller = new XmlController;
       $controller->importProductXml($command);
    }
}
