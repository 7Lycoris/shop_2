<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    //
    protected $table = 'nav';

    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $guarded = [];

    //多对多 反向
    public function goods()
    {
        return $this->belongsToMany('App\Model\Admin\Goods','goods_nav','nav_id','goods_id');
    }
}
