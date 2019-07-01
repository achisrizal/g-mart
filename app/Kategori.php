<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guard = 'admin';
    protected $table = 'kategori';
    public $fillable = ['id_kategori', 'nama_kategori'];
    protected $primaryKey='id_kategori';
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
