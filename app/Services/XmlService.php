<?php

namespace App\Services;

use App\Helpers\XmlHelper;
use Illuminate\Console\Command;

class XmlService
{
    public function importProductsByXml(Command $command, $file_name)
    {
       XmlHelper::importProductXml($command, $file_name);
    }
}
