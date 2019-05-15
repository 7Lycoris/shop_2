<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    //
    protected $table = 'link';

    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
