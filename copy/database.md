## 做一个简单的发布产品

1 . 创建模型同时生成迁移文件
`php artisan make:model Product --migration`

2 . 首先使用数据迁移生成对应的表
```
Schema::create('products', function (Blueprint $table) {
    $table->bigIncrements('product_id')->comment('产品id');
    $table->bigInteger('uid')->default(0)->comment('用户id');
    $table->string('name', 20)->default('')->comment('产品名称');
    $table->tinyInteger('product_type', false, true)->default(1)->comment('产品类型: 1.A产品,2.B产品,3.C产品');
    $table->string('introduction', 50)->comment('产品简介');
    $table->integer('created_at', false, true)->default(0)->comment('创建时间');
    $table->integer('updated_at', false, true)->default(0)->comment('更新时间');
    $table->integer('deleted_at', false, true)->default(0)->comment('删除时间');
});
\Illuminate\Support\Facades\DB::statement("ALTER TABLE `products` comment '产品表'"); // 表注释
```

3 . 设置语言格式
```
app.php设置

'faker_locale' => 'zh_CN',
```

4 . 使用模型工厂`php artisan make:factory ProductFactory`
```
$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'uid' => mt_rand(1,9999),
        'name' => $faker->name,
        'product_type' => mt_rand(1,3),
        'introduction' => $faker->unique()->text(50),
        'created_at' => $faker->dateTimeBetween('-3 year', '-1 year'),
        'updated_at' => $faker->dateTimeBetween('-1 year', '-5 month'),
    ];
});
```

5 . Seeder`php artisan make:seeder ProductSeeder`
```
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
   // 插入100万条数据
   factory(\App\Models\Product::class)->times(1000000)->make()->each(function ($model) {
       $model->save();
   });
}
```

6 . 执行指定seeder
`php artisan db:seed --class=DatabaseSeeder`
