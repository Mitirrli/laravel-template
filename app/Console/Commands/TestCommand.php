<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:co';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //设置进程数
        $worker_num = 3;

        $child = [];
        foreach (range(1, $worker_num) as $key => $value) {
            //使用多进程
            $pid = pcntl_fork();

            if ($pid == -1) {
                var_dump('创建子进程失败');
            }

            if ($pid) {
                $child[] = $pid;
                var_dump('进入了父进程.' . '进程id为:' . posix_getpid());
            } else {
                sleep(10);
                var_dump('进入了子进程.' . '进程id为:' . posix_getpid() . '.父进程id为:' . posix_getppid());
                exit();
            }
        }

        while (count($child) > 0) {
            foreach ($child as $key => $pid) {
                $res = pcntl_waitpid($pid, $status, WNOHANG);
                if ($res == -1 || $res > 0) {
                    unset($child[$key]);
                }
            }
            sleep(1);
        }
    }
}
