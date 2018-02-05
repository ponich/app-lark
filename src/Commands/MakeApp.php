<?php

namespace Ponich\AppLark\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeApp extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:app {name : имя приложения}';

    /**
     * @var string
     */
    protected $description = 'Создать новое приложения';

    /**
     * @var string относительный путь к каталогу с шаблоном
     */
    protected $templatePath = 'app/YouApp';

    /**
     * @var string
     */
    protected $templateName = 'YouApp';

    /**
     * @var string
     */
    protected $templateAbsolutePath;

    /**
     * @var string
     */
    protected $appAbsolutePath;

    /**
     * @var string
     */
    protected $name;

    /**
     * Точка входа
     * @throws \Exception
     */
    public function handle()
    {
        $this->name = ucfirst($this->argument('name'));

        $this->templateExists();

        $this->appExists($this->name);

        $this->copyTemplateToApp($this->getTemplateAbsolutePath(), $this->getAppAbsolutePath());

        $this->replaceDirectoryWithFiles();
    }

    /**
     * @return string
     */
    public function getTemplateAbsolutePath()
    {
        return $this->templateAbsolutePath;
    }

    /**
     * @return string
     */
    public function getAppAbsolutePath()
    {
        return $this->appAbsolutePath;
    }

    /**
     * @param $path
     */
    public function setTemplateAbsolutePath($path)
    {
        $this->templateAbsolutePath = $path;
    }

    /**
     * @param $path
     */
    public function setAppAbsolutePath($path)
    {
        $this->appAbsolutePath = $path;
    }

    /**
     * Входящий шаблон для поиска
     * @return array
     */
    protected function getTemplateIn()
    {
        return [$this->templateName];
    }

    /**
     * Исходящий шаблон для замены
     * @return array
     */
    protected function getTemplateOut()
    {
        return [$this->name];
    }

    /**
     * Сканирование всех файлов. Замена шаблонов
     * @param null|string $path
     */
    protected function replaceDirectoryWithFiles($path = null)
    {
        $path = $path ?? $this->getAppAbsolutePath();

        $files = File::allFiles($path);

        /**
         * @var \Symfony\Component\Finder\SplFileInfo $file
         */
        foreach ($files as $file) {
            // file content
            $content = str_replace(
                $this->getTemplateIn(),
                $this->getTemplateOut(),
                $file->getContents()
            );

            File::put($file->getRealPath(), $content);

            // filename
            $name = str_replace(
                $this->getTemplateIn(),
                $this->getTemplateOut(),
                $file->getFilename()
            );

            File::move($file->getRealPath(), $file->getPath() . '/' . $name);
        }

    }

    /**
     * Копирование каталога с шаблонов в каталог app
     * @param $from
     * @param $to
     * @return bool
     * @throws \Exception
     */
    protected function copyTemplateToApp($from, $to)
    {
        if (!File::copyDirectory($from, $to)) {
            throw new \Exception("Ошибка копирование шаблона приложения");
        }

        return true;
    }

    /**
     * Проверка, существует ли каталог с именем app
     * @param $name
     * @throws \Exception
     */
    protected function appExists($name)
    {
        if (file_exists($path = app_path($name))) {
            throw new \Exception("Приложения {$path} уже существует");
        }

        $this->setAppAbsolutePath($path);
    }

    /**
     * Проверка шаблона
     * @throws \Exception
     */
    protected function templateExists()
    {
        if (!file_exists($path = base_path($this->templatePath))) {
            throw new \Exception("Шаблон {$path} приложения не найден");
        }

        $this->setTemplateAbsolutePath($path);
    }
}
