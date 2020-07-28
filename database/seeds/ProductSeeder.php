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
        $childNum = 10;

        //多进程插入数据
        foreach (range(1, $childNum) as $value) {
            $pid = pcntl_fork();
            if ($pid < 0) {
                \Illuminate\Support\Facades\Log::info('fail to fork');
                exit();
            }
            //父进程
            if ($pid > 0) {
                \Illuminate\Support\Facades\Log::info('父进程进来了');
            } else {
                \Illuminate\Support\Facades\Log::info("第" . $value . "子进程:" . posix_getpid() . ',父进程:' . posix_getppid());

                factory(\App\Models\Product::class)->times(100000)->make()->each(function ($model) {
                    $model->save();
                });

                exit();
            }
        }
    }
}
