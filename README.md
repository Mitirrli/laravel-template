## Quickstart
```shell script
$ docker-compose up -d

$ docker exec -it skeleton_php sh
```

```shell script
$ composer i --no-dev

$ chown -R www-data:www-data storage/ bootstrap/
```

```shell script
$ php artisan route:scan
```

```php
使用注解路由可以去除模块中的RouteProvider

$this->app->register(RouteServiceProvider::class);

删除对应的route文件
```
