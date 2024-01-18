<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rule extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $primaryKey = 'kd_rule';

    protected $fillable = ['kd_rule', 'kd_gejala', 'kd_penyakit'];

    /**
     * Get the penyakit that owns the Rule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'kd_penyakit', 'kd_penyakit');
    }

    /**
     * Get the gejala that owns the Rule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class, 'kd_gejala', 'kd_gejala');
    }
}
