<?php

namespace App\Models;

use App\Models\Subkriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPuskesmas extends Model
{
    use HasFactory;

    /**
     * Get the subkriteria that owns the DataPuskesmas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'id_subkriteria', 'id');
    }

}