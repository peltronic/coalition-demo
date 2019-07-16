<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{

    protected $guarded = ['id','guid','slug','created_at','updated_at'];
}
