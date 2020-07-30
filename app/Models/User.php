<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    /**
     * 与模型关联的数据表.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * 表主键.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * 模型的日期字段保存格式。
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * 被禁止修改的字段.
     *
     * @var string[]
     */
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
}
