<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<a href="https://packagist.org/packages/sashagm/seo"><img src="https://img.shields.io/packagist/dt/sashagm/seo" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/sashagm/seo"><img src="https://img.shields.io/packagist/v/sashagm/seo" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/sashagm/seo"><img src="https://img.shields.io/packagist/l/sashagm/seo" alt="License"></a>
<a href="https://packagist.org/packages/sashagm/seo"><img src="https://img.shields.io/github/languages/code-size/sashagm/seo" alt="Code size"></a>
<a href="https://packagist.org/packages/sashagm/seo"><img src="https://img.shields.io/packagist/stars/sashagm/seo" alt="Code size"></a>

[![PHP Version](https://img.shields.io/badge/PHP-%2B8-blue)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-%2B10-red)](https://laravel.com/)

</p>



## SEO Builder

Добро пожаловать в документацию по использованию нашего сервиса для мета тегов!

Наш сервис предназначен для упрощения процесса создания и управления мета тегами на вашем сайте. Мета теги являются важной частью оптимизации сайта для поисковых систем и могут помочь улучшить позиции вашего сайта в результатах поиска.

Мы надеемся, что наш сервис поможет вам улучшить позиции вашего сайта в поисковых системах и упростит процесс управления мета тегами. Если у вас есть какие-либо вопросы или предложения, пожалуйста, свяжитесь с нашей службой поддержки.

### Оглавление:

- [Требования](#требования)
- [Установка](#установка)
- [Использование](#использование)
  - [Стартовое использование](#стартовое-использование)
  - [Кастомное описание](#кастомное-описание)
  - [Кастомное og описание](#кастомное-og-описание) 
  - [Кастомное описание и og описание](#кастомное-описание-и-og-описание)
  - [Получение данных](#получение-данных)  
- [Дополнительные возможности](#дополнительные-возможности)        
- [Тестирование](#тестирование)
- [Лицензия](#лицензия)

#### Требования

Основные требования для установки и корректной работы:

- `PHP` >= 8.0
- `Laravel` >= 10.x
- `Composer` >= 2.4.x

#### Установка

- composer reuire sashagm/seo
- php artisan seo:install


#### Использование

Для начала давайте определим наши вспомогательные мета данные в `.env`:

```php

APP_NAME="Laravel"
APP_OG_TYPE="website"
APP_OG_LOCALE="ru_RU"
APP_OG_IMAGE="/storage/images.jpg"
APP_KEYWORDS=""
APP_DESC=""
APP_ROBOTS=""
APP_OG_TITLE=""
APP_OG_DESC=""
```

Чтобы добавить мета теги на страницу, вам необходимо вставить соответствующий код в секцию <head> вашего HTML-кода в файле `layouts/app.blade.php` укажите директиву `@yield('meta')`:

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @yield('meta')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
```
##### Стартовое использование
Чтобы добавить мета теги на конкретную страницу, вам необходимо указать соответствующие значения в секциях @section('meta') в файле `resources/views/pages/example.blade.php`:

```php
@section('meta') @meta('key') @endsection
```

Здесь мы выводим значения ключей `keywords`, `description`, `robots`, `og_title`, `og_description` из модели, а если передано дополнительное описание, то выводим его вместо описания из модели. Если дополнительное описание не передано, то выводим только описание из модели.

Теперь мы можем определять метатеги для каждой страницы отдельно и передавать их в наш layouts через директиву @yield('meta'). Это позволит нам более гибко управлять метатегами и улучшить SEO-оптимизацию нашего сайта.
Давайте разберемся с методом `getPageMeta('key')` в него мы передаем ключ нашей категории. Поиск будет из модели по первому аргументу.

```php
@meta('key')
```
##### Кастомное описание
Если необходимо кастомное описание то достаточно передать вторым агрументом нашу строку она отобразится вместо нашего key->description.

```php
@meta('key','custom description')
```
##### Кастомное og описание
Если необходимо кастомное og описание то достаточно передать вторым аргументом пустую строку и третьим агрументом нашу строку она отобразится вместо нашего key->og_description.

```php
@meta('key','','custom og description')
```
##### Кастомное описание и og описание
Если необходимо кастомное описание и og описание то достаточно передать вторым аргументом строку для описания и третьим агрументом строку для og описание они отобразятся вместо наших key->og_description и key->og_description.

```php
@meta('key','custom description','custom og description')
```


#### Получение данных

Примеры вызовов функций модели Meta:

1. Получение значения атрибута `robots` с использованием доступа через свойство:
```php
$meta = Meta::find(1);
$robots = $meta->robots;
```

2. Получение значения атрибута `og_title` с использованием доступа через свойство:
```php
$meta = Meta::find(1);
$ogTitle = $meta->og_title;
```

3. Получение значения атрибута `og_description` с использованием доступа через свойство:
```php
$meta = Meta::find(1);
$ogDescription = $meta->og_description;
```

4. Получение значения атрибута `description` с использованием доступа через свойство:
```php
$meta = Meta::find(1);
$description = $meta->description;
```

5. Получение значения атрибута `keywords` с использованием доступа через свойство:
```php
$meta = Meta::find(1);
$keywords = $meta->keywords;
```

Во всех примерах мы используем метод find() для получения экземпляра модели Meta с определенным идентификатором (в данном случае 1). Затем мы обращаемся к нужному атрибуту, например, $meta->robots, чтобы получить его значение. Если значение атрибута не задано (NULL), то возвращается значение по умолчанию, указанное в соответствующей функции-аксессоре.


#### Дополнительные возможности

Наш пакет предоставляет ряд дополнительных возможностей, которые могут быть полезны при работе с сео:

- `php artisan seo:install` - Данная команда установит все необходимые файлы.

#### Тестирование

Для проверки работоспособности можно выполнить специальную команду:

- ./vendor/bin/phpunit --configuration phpunit.xml

#### Лицензия

SEO Builder - это программное обеспечение с открытым исходным кодом, лицензированное по [MIT license](LICENSE.md ).



