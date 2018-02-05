<?php

namespace App\YouApp\Console\Commands\Foundation;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class RequestMakeCommand extends GeneratorCommand
{
    use CustomNamespace {
        rootNamespaceTrait as protected rootNamespace;
        getPathTrait as protected getPath;
    }

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form request class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        // set name
        $this->setName($this->getLowName() . '-make:request');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = base_path('vendor/laravel/framework/src/Illuminate/Foundation/Console');

        return $stub . '/stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }
}
