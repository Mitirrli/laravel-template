```
清除模型的缓存

php artisan modelCache:clear --model=App\\Question
```


```
关联关系删除下级的数据需要通知上级

protected $touches = ['question'];

public function question()
{
    return $this->belongsTo('App\Question', 'q_id', 'q_id');
}

test:
$model = Answer::query()->find(1);

$model->delete();

$res = Question::query()->with('answer')->find(1)->toArray();
```
