<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Myadd extends Model
{
    
    //与模型关联的数据表
    protected $table = 'myadd';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
