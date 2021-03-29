<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaMedis extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_puskesmas',
        'nik',
        'nama',
        'nip',
        'tanggal_lahir',
        'status',
        'jenis_kelamin',
        'jenis_tenaga',
        'nomor_str',
        'tanggal_awal_str',
        'tanggal_akhir_str',
        'sip',
        'tanggal_sip'
    ];


    /**
     * Get the alternatif that owns the TenagaMedis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'jenis_tenaga', 'id');
    }
}