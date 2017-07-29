<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/26
 * Time: 9:57
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //指定表明
    protected $table = 'student';

    //指定主键id
    protected $primaryKey = 'id';
}