<?php

declare(strict_types=1);

namespace App\Tools;

class RT
{
    public static array $data = [];

    public function errCode(int $code): RT
    {
        self::$data['error']['code'] = $code;

        return $this;
    }

    public function errMessage(string $message): RT
    {
        self::$data['error']['message'] = $message;

        return $this;
    }

    public function data($data): RT
    {
        self::$data['data'] = $data;

        return $this;
    }

    public function code(int $code): RT
    {
        self::$data['code'] = $code;

        return $this;
    }

    public function message(string $message): RT
    {
        self::$data['message'] = $message;

        return $this;
    }

    public function getResult(): array
    {
        return self::$data;
    }
}
