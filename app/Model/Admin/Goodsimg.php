<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goodsimg extends Model
{
    //
    protected $table = 'goodsimg';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
