<?php

namespace App\Tools;

class RT
{
    const DEFAULT_DATA = [];

    const DEFAULT_CODE = 1000;

    const DEFAULT_MESSAGE = 'success';

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

    public function initParam()
    {
        self::$data['data'] = self::DEFAULT_DATA;
        self::$data['code'] = self::DEFAULT_CODE;
        self::$data['message'] = self::DEFAULT_MESSAGE;
    }

    public function data($data): RT
    {
        $this->initParam();

        self::$data['data'] = $data;

        return $this;
    }

    public function code(int $code): RT
    {
        $this->initParam();

        self::$data['code'] = $code;

        return $this;
    }

    public function message(string $message): RT
    {
        $this->initParam();

        self::$data['message'] = $message;

        return $this;
    }

    public function getResult(): array
    {
        return self::$data;
    }
}
