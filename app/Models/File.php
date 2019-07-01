<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午5:20
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = [
        'path',
        'original_name',
        'size',
        'mime',
        'hash',
        'url'
    ];
}
