<?php
namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    //
    protected $table = 'Goods';

    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $guarded = [];
}