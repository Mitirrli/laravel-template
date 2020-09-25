<?php

namespace App\Tools;

class RT
{
    public static array $data = [];

    public function setErrCode(int $code): RT
    {
        self::$data['error']['code'] = $code;

        return $this;
    }

    public function setErrMessage(string $message): RT
    {
        self::$data['error']['message'] = $message;

        return $this;
    }

    public function setReturnData($data): RT
    {
        self::$data['data'] = $data;

        return $this;
    }

    public function setReturnCode(int $code): RT
    {
        self::$data['code'] = $code;

        return $this;
    }

    public function setReturnMessage(string $message): RT
    {
        self::$data['message'] = $message;

        return $this;
    }

    public function getResult(): array
    {
        return self::$data;
    }
}
