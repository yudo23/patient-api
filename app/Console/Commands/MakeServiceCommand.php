<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Generate a Service class in app/Services';

    public function handle()
    {
        $name = $this->argument('name');
        $serviceClassName = ucfirst($name) . 'Service';
        $servicePath = app_path("Services/{$serviceClassName}.php");

        if (File::exists($servicePath)) {
            $this->error("Service {$serviceClassName} already exists!");
            return;
        }

        if (!File::isDirectory(app_path('Services'))) {
            File::makeDirectory(app_path('Services'), 0755, true);
        }

        $template = "<?php

        namespace App\Services;

        class {$serviceClassName}
        {
            // TODO: Add your service logic here
        }";

        File::put($servicePath, $template);

        $this->info("Service {$serviceClassName} created successfully at app/Services/");
    }
}
