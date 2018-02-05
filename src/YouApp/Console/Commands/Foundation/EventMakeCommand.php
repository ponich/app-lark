<?php

namespace App\YouApp\Console\Commands\Foundation;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class EventMakeCommand extends GeneratorCommand
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
    protected $description = 'Create a new event class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Event';

    /**
     * EventMakeCommand constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        // set name
        $this->setName($this->getLowName() . '-make:event');
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($rawName);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = base_path('vendor/laravel/framework/src/Illuminate/Foundation/Console');

        return $stub . '/stubs/event.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Events';
    }
}
