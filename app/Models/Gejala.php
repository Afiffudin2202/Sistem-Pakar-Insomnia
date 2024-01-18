<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $primaryKey = 'kd_gejala';
    protected $fillable = ['kd_gejala', 'nama_gejala'];

}
