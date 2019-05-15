<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Linkman extends Model
{
    //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'orders';

    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
