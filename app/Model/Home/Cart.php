<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'cart';

    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
