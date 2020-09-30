# Laravel多模块开发

```shell script
$ composer require nwidart/laravel-modules

$ php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
```

```shell script
生成模块

$ php artisan module:make module-name
```

```
模块位置修改

'namespace' => 'App\Modules',

'modules' => base_path('app/Modules')
```

```php
使用注解

/**
 * The classes to scan for route annotations.
 *
 * @var array
 */
protected $scanRoutes = [
  'App\Modules\Circle\Http\Controllers\CircleController',
];
```

```php
删除服务提供者中对应的无用方法

$this->registerViews();
$this->registerFactories();
```

```shell script
生成模型

$ php artisan module:make-model Question Circle
```
