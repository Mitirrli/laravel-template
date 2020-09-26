```
绑定接口到实现

$this->app->bind(
    'App\Contracts\EventPusher',
    'App\Services\RedisEventPusher'
);


use App\Contracts\EventPusher;

/**
 * 创建一个新的类实例
 *
 * @param  EventPusher  $pusher
 * @return void
 */
public function __construct(EventPusher $pusher)
{
    $this->pusher = $pusher;
}
```
