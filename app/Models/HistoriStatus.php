<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriStatus extends Model
{
    protected $table = 'histori_status';
    protected $primaryKey = 'id_histori';
    public $timestamps = false;
    
    protected $fillable = [
        'id_aspirasi',
        'status',
        'tanggal'
    ];

    // Relasi
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi', 'id_aspirasi');
    }
}