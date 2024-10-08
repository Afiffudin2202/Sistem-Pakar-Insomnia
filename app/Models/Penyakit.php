<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $primaryKey = 'kd_penyakit';
    protected $fillable = [
        'kd_penyakit',
        'nama_penyakit',
        'penyembuhan'
    ];

    
}
