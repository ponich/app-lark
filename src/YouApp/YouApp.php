<?php

namespace App\YouApp;

use Illuminate\Support\Str;

class YouApp
{
    /**
     * @var string
     */
    protected $name = 'YouApp';

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $application;

    /**
     * YouApp constructor.
     */
    public function __construct()
    {
        $this->application = app();
    }

    /**
     * Вернет абсолютный путь апп
     * @param  string|null $path
     * @return string
     */
    public function appPath($path = null)
    {
        return app_path($this->getName() . '/' . $path);

    }

    /**
     * Вернет namespace app
     * @param null $path
     * @return mixed
     */
    public function getNamespace($path = null)
    {
        return str_replace(
            ['\\\\'],
            ['\\'],
            $this->application->getNamespace() . '\\' . $this->getName() . '\\' . $path
        );
    }

    /**
     * Вернет имя app
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Вернем имя app в нижнем регистре
     * @return string
     */
    public function getLowName()
    {
        return strtolower($this->getName());
    }
}