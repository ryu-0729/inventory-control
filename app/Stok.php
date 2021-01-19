<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    // 追加・更新をして良いカラムの設定
    protected $fillable = ['name', 'price', 'quantity', 'role'];
}
