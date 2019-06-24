<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guard = 'admin';
    protected $table = 'kategori';
    public $fillable = ['id_kategori', 'nama_kategori'];
}
