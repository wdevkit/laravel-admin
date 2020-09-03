<?php

namespace Webdk\Admin\Commands;

use Illuminate\Console\Command;

class AdminCommand extends Command
{
    public $signature = 'admin';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
