## Getresponse API Client
[![Packagist License](https://poser.pugx.org/ponich/app-lark/license.png)](http://choosealicense.com/licenses/mit/)
[![Latest Stable Version](https://poser.pugx.org/ponich/app-lark/version.png)](https://packagist.org/packages/ponich/app-lark)
[![Total Downloads](https://poser.pugx.org/ponich/app-lark/d/total.png)](https://packagist.org/packages/ponich/app-lark)

Вы сможете создать свое HMVC приложения. После создания приложения, вы сможете создавать отдельные роуты, модели и контроллеры через `artisan`.

Каждое приложения будет иметь свой сервис-провайдер, фасад и пространство имен, что дает возможность разделить гигантскую логику приложения на Laravel.


### Установка

- Воспользуйтесь composer для установки пакета

```
    composer require ponich/app-lark:dev-master
```

- Далее, добавьте сервис-провайдер в ``config/app.php``:

```php
'providers' => [
    // ...
    Ponich\AppLark\ServiceProvider::class
]
```

> в Laravel >= 5.5 процедуру с добавлениям сервис-провайдера делать не нужно

- Запустите ``composer dumpautoload``. Это не обязательно, но может избавить от кое каких проблем

**Все! Пакет установлен и готов к работе**


### Создания приложения

Для удобного управления вашими приложениями, рекомендую использовать `artisan`. Чтобы создать Ваше первое приложения, запустите консольную команду ``./artisan make:app YouApp``, где _YouApp_ - пространство имен вашего приложения.

> _YouApp_ должно быть уникальным именем, которого нету в пространстве имен ``App\``

Если вы не увидели ошибок, это хороший знак и Вам нужно приступить к подключению сервис-провайдера и фасада созданного приложения.

**Провайдер**

```php
'providers' => [
    // ...
    App\YouApp\Providers\AppServiceProvider::class
]
```

**Фасад** 

```php
'aliases' => [
    // ...
    'YouApp' => App\YouApp\Providers\Facade::class
]
```

Приложения создано и готово к работе.

Вы также можете создавать свои `Controllers`, `Events`, `Listeners`, `Models`, `Request`, `ConsoleCommands` через `artisan`. Для этого были автоматически добавлены следующие команды:

- `youapp-make:command`     Create a new Artisan command

- `youapp-make:controller`  Create a new controller class

- `youapp-make:event`       Create a new event class

- `youapp-make:listener`    Create a new event listener class

- `youapp-make:model`       Create a new Eloquent model class

- `youapp-make:request`     Create a new form request class



