## SEO Builder

Добро пожаловать в документацию по использованию нашего сервиса для мета тегов!

Наш сервис предназначен для упрощения процесса создания и управления мета тегами на вашем сайте. Мета теги являются важной частью оптимизации сайта для поисковых систем и могут помочь улучшить позиции вашего сайта в результатах поиска.

Мы надеемся, что наш сервис поможет вам улучшить позиции вашего сайта в поисковых системах и упростит процесс управления мета тегами. Если у вас есть какие-либо вопросы или предложения, пожалуйста, свяжитесь с нашей службой поддержки.

#### Установка

- composer reuire sashagm/seo
- php artisan vendor:publish --provider='Sashagm\Seo\Providers\SeoServiceProvider'
- php artisan migrate


#### Использование

1. Чтобы добавить мета теги на страницу, вам необходимо вставить соответствующий код в секцию <head> вашего HTML-кода в файле `layouts/app.blade.php` укажите директиву `@yield('meta')`:

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

2. Чтобы добавить мета теги на конкретную страницу, вам необходимо указать соответствующие значения в секциях @section('meta') в файле `resources/views/pages/example.blade.php`:

```php
@section('meta')
    @php
        $page_meta = app(\Sashagm\Seo\Services\MetaService::class)->getPageMeta('key');
    @endphp

    <meta name="keywords" content="{{ $page_meta['keywords'] }}">
    <meta name="description" content="{{ $page_meta['description'] }}">
@endsection
```

Здесь мы выводим значения ключей `keywords` и `description` из модели, а если передано дополнительное описание, то выводим его вместо описания из модели. Если дополнительное описание не передано, то выводим только описание из модели.

3. Теперь мы можем определять метатеги для каждой страницы отдельно и передавать их в наш layouts через директиву @yield('meta'). Это позволит нам более гибко управлять метатегами и улучшить SEO-оптимизацию нашего сайта.
4. Давайте разберемся с методом `getPageMeta('key')` в него мы передаем ключ нашей категории. Поиск будет из модели.

```php
$page_meta = app(\Sashagm\Seo\Services\MetaService::class)->getPageMeta('key');
```

5. Если необходимо кастомное описание то достаточно передать вторым агрументом нашу строку.

```php
$page_meta = app(\Sashagm\Seo\Services\MetaService::class)->getPageMeta('key', 'custom description');
```

#### Тестирование

Для проверки работоспособности можно выполнить специальную команду:

- ./vendor/bin/phpunit --configuration phpunit.xml

#### Лицензия

SEO Builder - это программное обеспечение с открытым исходным кодом, лицензированное по [MIT license](LICENSE.md ).



