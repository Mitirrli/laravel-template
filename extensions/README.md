# Here is the place to store extension.

```
mkdir in the extension and init your composer.
```

```
项目中使用未发布的组件包
假设项目目录如下

/opt/ 项目目录
/opt/extension 组件包目录

假设组件名为 your_component/your_component

修改 /opt/project/composer.json

以下省略其他不相干的配置

{
    "require": {
        "your_component/your_component": "dev-master"
    },
    "repositories": {
        "your_component": {
            "type": "path",
            "url": "/opt/extension/your_component"
        }
    }
}
```
