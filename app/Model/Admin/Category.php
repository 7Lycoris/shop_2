<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //分类模型
    protected $table = 'category';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $guarded = [];
}
