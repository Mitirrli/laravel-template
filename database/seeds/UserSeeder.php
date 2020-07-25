<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 插入1万条数据
        for ($i = 0; $i < 10; $i++) {
            factory(\App\Models\User::class)->times(1000)->make()->each(function ($model) {
                $model->save();
            });
        }
    }
}
