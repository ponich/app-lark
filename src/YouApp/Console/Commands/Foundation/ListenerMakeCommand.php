<?php

namespace App\YouApp\Console\Commands\Foundation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ListenerMakeCommand extends GeneratorCommand
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
    protected $name = 'make:listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event listener class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Listener';

    /**
     * ListenerMakeCommand constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        // set name
        $this->setName($this->getLowName() . '-make:listener');
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $event = $this->option('event');

        if (!Str::startsWith($event, [
            $this->rootNamespace(),
            'Illuminate',
            '\\',
        ])) {
            $event = $this->rootNamespace() . 'Events\\' . $event;
        }

        $stub = str_replace(
            'DummyEvent', class_basename($event), parent::buildClass($name)
        );

        $event = str_replace(['/'], ['\\'], $event);

        return str_replace(
            'DummyFullEvent', $event, $stub
        );
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = base_path('vendor/laravel/framework/src/Illuminate/Foundation/Console');

        if ($this->option('queued')) {
            return $this->option('event')
                ? $stub . '/stubs/listener-queued.stub'
                : $stub . '/stubs/listener-queued-duck.stub';
        }

        return $this->option('event')
            ? $stub . '/stubs/listener.stub'
            : $stub . '/stubs/listener-duck.stub';
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
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Listeners';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['event', 'e', InputOption::VALUE_OPTIONAL, 'The event class being listened for.'],

            ['queued', null, InputOption::VALUE_NONE, 'Indicates the event listener should be queued.'],
        ];
    }
}
