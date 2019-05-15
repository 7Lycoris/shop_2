<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = 'goods';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];

    public function gimgs()
    {
        return $this->hasMany('App\Model\Admin\Goodsimg','gid','id');
    }

    public function gimg()
    {
        return $this->hasOne('App\Model\Admin\Goodsimg','gid','id');
    }
    
    public function navs()
    {
        return $this->belongsToMany('App\Model\Admin\Nav','goods_nav','goods_id','nav_id');
    }
}
