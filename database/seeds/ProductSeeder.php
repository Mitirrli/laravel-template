<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 插入100万条数据
        for ($i = 0; $i < 100; $i++) {
            factory(\App\Models\Product::class)->times(10000)->make()->each(function ($model) {
                $model->save();
            });
        }
    }
}
