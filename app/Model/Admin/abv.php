<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Abv extends Model
{
    //
    protected $table = 'abv';

    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
