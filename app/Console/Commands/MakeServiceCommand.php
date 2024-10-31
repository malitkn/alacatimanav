<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $namespace = 'App\Services';

    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service class';

    protected function getStubPath(): string
    {
        return base_path('\stubs\class.stub');
    }

    protected function getStub()
    {
        return File::get($this->getStubPath());
    }

    protected function getFilePath()
    {
        return app_path('Services/' . $this->argument('name') . '.php');
    }

    protected function createDirectoryIfNotExists(): void
    {
        $path = $this->getFilePath();
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        $path = $this->getFilePath();
        $name = $this->argument('name');
        if (file_exists($path)) {
            $this->fail('File already exists');
        }

        $this->createDirectoryIfNotExists();
        $className = class_basename($name);
        $directory = dirname($name);

        $content = Str::swap(
            [
                '{{ class }}' => $className,
                '{{ namespace }}' => $directory !== '.' ? $this->namespace . '/' . $directory : $this->namespace,
            ], $this->getStub());

        if (File::put($path, $content)) {
            $this->info('Service is succesfully created at ' . $path);
        }
    }
}
