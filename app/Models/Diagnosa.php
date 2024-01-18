<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnosa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the user that owns the Diagnosa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kd_user', 'id');
    }

    /**
     * Get the rule that owns the Diagnosa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rule(): BelongsTo
    {
        return $this->belongsTo(Rule::class, 'kd_penyakit', 'kd_penyakit');
    }

   
}
