<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'desa';
    protected $primaryKey = 'id_desa';
    protected $fillable = ['id_desa', 'nama_desa'];

    public $timestamps = false;
}
