<?php

namespace App\YouApp\Console\Commands\Foundation;

use App\YouApp\Facade as YouApp;
use Illuminate\Support\Str;

trait CustomNamespace
{
    /**
     * Вернет namespace для элемента app
     * @return string
     */
    protected function rootNamespaceTrait()
    {
        return YouApp::getNamespace($this->getNamespacePrefix());
    }

    /**
     * Вернет абсолютный путь к новому файлу
     * @param  string $name
     * @return string
     */
    protected function getPathTrait($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return YouApp::getNamespace($this->getNamespacePrefix()) . '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Вернет префикс для namespace app
     * @return null|string
     */
    protected function getNamespacePrefix()
    {
        $prefix = null;

        if ($this->type == 'Model') {
            $prefix = '\\Models';
        }

        return $prefix;
    }

    /**
     * Вернет имя app в нижнем регистре
     * @return string
     */
    protected function getLowName()
    {
        return YouApp::getLowName();
    }

    /**
     * Изменения переменных в шаблонах
     * @param  string $stub
     * @param  string $name
     * @return $this
     */
    protected function replaceNamespaceTrait(&$stub, $name)
    {
        $stub = str_replace(
            [
                'DummyNamespace',
                'DummyRootNamespace',
                'NamespacedDummyUserModel',
                'DummyModelClassExtend'
            ],
            [
                $this->getNamespace($name),
                $this->rootNamespace(), config('auth.providers.users.model'),
                YouApp::getNamespace('Models\Model')
            ],
            $stub
        );

        return $this;
    }
}