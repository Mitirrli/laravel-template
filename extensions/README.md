# Here is the place to store extension.

```
mkdir in the extension and init your composer.
```

```
项目中使用未发布的组件包
假设项目目录如下

/ 项目目录
/extension 组件包目录

假设组件名为 your_component/your_component

修改 /composer.json

以下省略其他不相干的配置

{
    "require": {
        "your_component/your_component": "dev-master"
    },
    "repositories": {
        "your_component": {
            "type": "path",
            "url": "extension/your_component"
        }
    }
}

examples:

"require-dev": {
    ...
    "mitirrli/model-cache": "^0.0.1",
}

"repositories": {
    "model-cache": {
        "type": "path",
        "url": "/skeleton/extensions/model-cache"
     }
},
```

composer包开发



```php
发布配置文件

<?php

namespace Mitirrli\Cache\Providers;

use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $configPath = __DIR__ . '/../../config/model-cache.php';

        $this->publishes([
            $configPath => config_path('model-cache.php')
        ]);
    }
}


"extra": {
    "laravel": {
        "providers": [
            "Mitirrli\\Cache\\Providers\\Service"
        ]
    }
}
```
