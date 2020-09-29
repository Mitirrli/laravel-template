<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;

class CachedModel extends \GeneaLabs\LaravelModelCaching\CachedModel
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    const DELETED_AT = 'delete_time';

    protected $dateFormat = 'U';

    protected $fillable = [];

    protected $hidden = ['delete_time'];

    /**
     * 为数组 / JSON 序列化准备日期。
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
