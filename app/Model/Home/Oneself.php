<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Oneself extends Model
{
    //
    protected $table = 'homeuser';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
