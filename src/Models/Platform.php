<?php
namespace JoyRiddle\MSign\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{


    // 开启软删除
    use SoftDeletes;
    // 软删除标识字段
    protected $dates = ['deleted_at'];


}
